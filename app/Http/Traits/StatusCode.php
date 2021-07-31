<?php

namespace App\Traits;

trait StatusCode {
  static $StatusOK = 200;
  static $StatusCreated = 201;
  static $StatusNoContent = 204;
  static $StatusBadRequest = 400;
  static $StatusNotFound = 404;
  static $StatusInternalServerError = 500;
}