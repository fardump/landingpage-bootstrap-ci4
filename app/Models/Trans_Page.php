<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Trans_Page extends Model
{
    protected $table = 'tb_contact';
    protected $aliastable = ' a';
    protected $column_order = ['id', 'subjectnm', 'message'];
    protected $column_search = ['subjectnm'];
    protected $order = ['id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table . $this->aliastable);
    }

    private function getDatatablesQuery($request)
    {
        $this->request = $request;
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function datatables_contact(RequestInterface $request)
    {
        $this->getDatatablesQuery($request);
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();

        return $query->getResult();
    }

    public function countFiltered(RequestInterface $request)
    {
        $this->getDatatablesQuery($request);
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    function insertHD($data)
    {
        return $this->dt->insert($data);
    }

    function edit($data, $id)
    {
        return $this->dt->update($data, ['standupid' => $id]);
    }

    function hapus($id)
    {
        return $this->dt->delete(['standupid' => $id]);
    }
}
