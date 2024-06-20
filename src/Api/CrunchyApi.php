<?php

namespace Alice\Animeland\Api;

class CrunchyApi {
  
  private static $baseUrl = "https://www.crunchyroll.com/watch/";
  private static $path = "../../bin/crunchy-cli/crunchy-cli";


  // endpoint example: GYW4WKJN6/rebirth, GRDQPM1ZY/alone-and-lonesome
  public static function Download(string $endpoint) {
      $endpoint = escapeshellarg($endpoint);
      $audio = " -a pt-BR ";
      $subtitle = " -s pt-BR ";
      $skip = " --skip-existing ";
      
      $command = self::$path . ' download' . $audio . $subtitle . $skip . self::$baseUrl . $endpoint;

      echo "preparing...";

      $descriptorspec = array(
          0 => array("pipe", "r"),  // stdin
          1 => array("pipe", "w"),  // stdout
          2 => array("pipe", "w")   // stderr
      );

      $process = proc_open($command, $descriptorspec, $pipes);

      if (is_resource($process)) {
          fclose($pipes[0]);  // Close the input pipe since we're not writing to the process
          fclose($pipes[1]);
          fclose($pipes[2]);

          // It's important to close any pipes before calling `proc_close`
          $exitCode = proc_close($process);

          if ($exitCode === 0) {
              echo "ok";
          } else {
              echo "Failed to download. Exit code: $exitCode";
          }
      } else {
          echo "Failed to start the process.";
      }
  }
}

CrunchyApi::Download("GRDQPM1ZY/alone-and-lonesome");
