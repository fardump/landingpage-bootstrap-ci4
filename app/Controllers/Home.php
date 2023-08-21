<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Trans_Page;
use Config\Services;

class Home extends BaseController
{
    public function __construct()
    {
        $this->pages = new Trans_Page();
    }

    public function index()
    {
        $data['title'] = "Portal Berita";
        $data['bannertitle'] = "Portal Berita";
        $data['content'] = "pages/home";

        echo view('index', $data);
    }

    public function contact()
    {
        $data['title'] = "Contact Us";
        $data['bannertitle'] = "Contact Us";
        $data['content'] = "pages/contact";

        echo view("index", $data);
    }

    public function DatatablesContact()
    {
        $request = Services::request();

        if ($request->getMethod(true) === 'POST') {
            $lists = $this->pages->datatables_contact($request);
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $row = [];

                $row[] = $no++;
                $row[] = $list->subjectnm;
                $row[] = "";
                $row[] = $list->message;
                $row[] = "";
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsFiltered' => $this->pages->countFiltered($request),
                'recordsTotal' => $this->pages->countAll(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }

    public function process_sendcontact_data()
    {
        $this->db->transBegin();

        $content["subjectnm"] = $this->request->getPost('name');
        $content["message"] = $this->request->getPost('message');
        $this->pages->insertHD($content);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();

            $e['RESULT'] = "ERROR";
            $e['MESSAGE'] = "Error!!!";
            echo json_encode($e);
        } else {
            $this->db->transCommit();
            $e['RESULT'] = "SUCCESS";
            $e['MESSAGE'] = "Success!!!";
            echo json_encode($e);
        }
    }
}
