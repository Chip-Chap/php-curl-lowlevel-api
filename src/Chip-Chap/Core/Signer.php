<?php
namespace ChipChap\Core;

interface Signer{
  public function sign(Request $request);
}
