<?php

namespace App\Exceptions\OpenFoodsFacts;

use Throwable;
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
     * OopsException constructor.
     *
     * @param Throwable $throwable
     */
    public function __construct(Throwable $throwable)
    {
        parent::__construct($throwable->getMessage());

        $this->message = $throwable->getMessage();
    }

    /**
     * Render view with error.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('error', [
            'message' => $this->message
        ]);
    }
}
