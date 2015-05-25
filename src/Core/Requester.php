<?php
namespace ChipChapLL\Core;

interface Requester{
    public function send(Request $request);
}