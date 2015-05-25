<?php
namespace ChipChap\Core;

interface Requester{
    public function send(Request $request);
}