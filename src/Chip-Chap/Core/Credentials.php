<?php
namespace ChipChap\Core;


interface Credentials{
    public function getPublicId();
    public function getSecret();
}