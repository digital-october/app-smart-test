<?php

namespace App\Exceptions\OpenFoodsFacts;

use Exception;

class OopsException extends Exception
{

    /**
     * The error message used for the response.
     *
     * @var string
     */
    protected $message;

    /**
     * BadRequestException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = 'Oops, there was an error in products request')
    {
        parent::__construct($message);

        $this->message = $message;
    }


    public function render()
    {
        return view('error', [
            'message' => $this->message
        ]);
    }
}
