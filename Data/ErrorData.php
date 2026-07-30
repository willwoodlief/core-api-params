<?php

namespace App\Data\ApiParams\Data;



use App\Data\ApiParams\Common\IResponse;
use App\Exceptions\RefCodes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Optional;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Present;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Symfony\Component\HttpFoundation\Response as CodeOf;
use Throwable;


/**
 * Show details about a server
 */
#[TypeScript]
#[MergeValidationRules]
#[OA\Schema(schema: 'Error')]
class ErrorData extends Data implements IResponse
{

    public function __construct(





        #[OA\Property(  title: 'Error message ',description: 'Describes the problem', example: 'You have not been assigned to this project')]
        public string $message,

        #[OA\Property(  title: 'Path',description: 'The path or route this happened on', )]
        public ?string $path,


        #[OA\Property(  title: 'Status of the error ',description: 'This is normally a http code', example: 400)]
        public int $status,


        #[OA\Property( title: 'Error time',description: "When this was made", type: 'string', format: 'datetime',example: "2025-02-25T15:00:59-06:00",nullable: true)]
        #[WithCast(DateTimeInterfaceCast::class, format: DATE_ATOM)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: DATE_ATOM)]
        public Carbon $created_at,


        #[OA\Property(  title: 'Error type code ',description: 'App specific code', example: 628)]
        public null|int $instance_code,

        #[OA\Property(  title: 'Type of error ', description: 'Help with the error', format: 'url')]
        public ?string $type = null,

        #[Present]
        #[OA\Property( title:"Errors",description: 'Additional errors',items: new OA\Items(type: 'string'),nullable: true)]
        /** @var string[] $other_errors */
        public array $other_errors = [],


    ) {

    }



    public static function rules(ValidationContext $context): array
    {
        return [

        ];
    }

    public static function fromException(Throwable $e): ErrorData
    {
        $info = [];
        $info['other_errors'] = [];


        if (class_exists('\App\Exceptions\HexbatchCoreException') && $e instanceof \App\Exceptions\HexbatchCoreException) {
            // Default response of 400
            $info['status'] = $e->getCode();
            if (empty($info['status'])) {
                $info['status'] = 400;
            }
            if ($info['status'] < 100 || $info['status'] >= 600) {
                $info['status'] = 400;
            }

            $info['type'] = $e->getRefCodeUrl();
            $info['message'] = $e->getMessage();
            $info['instance_code'] = $e->getRefCode();


            $other = $e->getPrevious();
            while ($other) {
                $info['other_errors'][] = $other->getMessage();
                $other = $other->getPrevious();
            }
        }

        else if ($e instanceof \Illuminate\Validation\ValidationException)
        {

            $info['status'] = $e->status;
            $info['message'] = $e->getMessage();

            foreach ($e->errors() as $ke => $err_array) {
                $sub_message = "$ke:    ";
                if (is_string($err_array)) { $err_array = [$err_array];}
                $issues = implode(" | ",$err_array);
                $sub_message .= $issues;
                $info['other_errors'][] = $sub_message;
            }
            $info['instance_code'] = RefCodes::VALIDATION;

            $other = $e->getPrevious();
            while ($other) {
                $info['other_errors'][] = $other->getMessage();
                $other = $other->getPrevious();
            }

        }
        else if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $info['status'] = ($e->getCode()?: CodeOf::HTTP_NOT_FOUND);
            $info['message'] = $e->getMessage();
        }
        else if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $info['status'] = ($e->getCode()?: CodeOf::HTTP_NOT_FOUND);
            $info['message'] = $e->getMessage();
        }
        else {
            $info['status'] = CodeOf::HTTP_BAD_REQUEST;
            $info['instance_code'] = $e->getCode()?:null;
            $info['message'] = $e->getMessage();

            $other = $e->getPrevious();
            while ($other) {
                $info['other_errors'][] = $other->getMessage();
                $other = $other->getPrevious();
            }
        }
        $info['path'] = Request::fullUrl();
        $info['created_at'] = Carbon::now()->timezone('UTC')->toIso8601String();

        $there =  static::factory()
            ->withoutOptionalValues()
            ->from($info);

        static::validate($there->toArray());

        return $there;
    }

    public function getHttpCode() : int {
        return $this->status;
    }

    public static function handlesThisException(Throwable $e) :bool  {
        if($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) return true;
        if($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) return true;
        if($e instanceof \Illuminate\Validation\ValidationException) return true;
        if(class_exists('\App\Exceptions\HexbatchCoreException') && $e instanceof \App\Exceptions\HexbatchCoreException) return true;
        return false;
    }


}
