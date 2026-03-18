<?php

declare(strict_types=1);

namespace App\Controllers;

class Demo extends BaseController
{
    public function index()
    {
        return view('demo_form');
    }

    public function submit()
    {
        $name = (string) $this->request->getPost('name');

        return $this->response->setJSON([
            'ok'   => true,
            'name' => $name,
            'csrf' => [
                'name'  => csrf_token(),
                'value' => csrf_hash(),
            ],
        ]);
    }
}
