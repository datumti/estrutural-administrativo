<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use App\Models\Construction;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function addFlash($message, $status = 'info')
    {
        Session::flash('flash-message', $message);
        Session::flash('flash-alert', $status);
    }

    public function getCheckConstruction($warningMessage, $warningType) {
        $construction = Session::get('construction');

        if(!$construction) {
            $this->addFlash($warningMessage, $warningType);
            return redirect('logout');
        }

        return $construction;
    }
}
