<?php

function getHeader($params = array())
{
    $data["pagetitle"] = $params[0];
    $data["bannertitle"] = $params[1];

    echo view('skin/header', $data);
}

function getFooter()
{
    echo view('skin/footer');
}

function getContent($content)
{
    echo view($content);
}
