<?php

namespace app\Controllers;

use app\Models\AddressModel;
use app\Modules\View;
use Exception;

class AddressController
{
    public static function index(): bool|string
    {
        return View::display('address/index');
    }

    /**
     * @throws \Exception
     */
    public static function saveHistory()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $address = $_POST['address'];
                $model = new AddressModel();
                $model->saveAddress($address);
            }
            redirect('/address/index');
            return true;
        } catch (\Exception $e) {
            http_response_code(500);
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public static function history(): bool|string
    {
        $model = new AddressModel();
        $history = $model->getHistory();
        $data = [
            'history' => $history
        ];
        return View::display('address/history', $data);
    }
}
