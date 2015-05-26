<?php
namespace ChipChapLL\Core;

interface Signer{
  public function sign(Request $request);
}
