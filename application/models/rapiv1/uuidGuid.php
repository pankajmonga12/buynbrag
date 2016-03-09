<?php
class UUID extends CI_Model
{
  
  public function __construct()
  {
    parent::__construct();
  }

  public static function v3($namespace, $name)
  {
    if(!self::is_valid($namespace))
      return false;

    // Get hexadecimal components of namespace
    $nhex = str_replace(array('-','{','}'), '', $namespace);

    // Binary Value
    $nstr = '';

    // Convert Namespace UUID to bits
    for($i = 0; $i < strlen($nhex); $i+=2)
    {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    // Calculate hash value
    $hash = md5($nstr . $name);

    return sprintf('%08s-%04s-%04x-%04x-%12s',

                    // 32 bits for "time_low"
                    substr($hash, 0, 8),

                    // 16 bits for "time_mid"
                    substr($hash, 8, 4),

                    // 16 bits for "time_hi_and_version",
                    // four most significant bits holds version number 3
                    (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,

                    // 16 bits, 8 bits for "clk_seq_hi_res",
                    // 8 bits for "clk_seq_low",
                    // two most significant bits holds zero and one for variant DCE1.1
                    (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

                    // 48 bits for "node"
                    substr($hash, 20, 12)
                  );
  }

  public static function v4()
  {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

                    // 32 bits for "time_low"
                    mt_rand(0, 0xffff), mt_rand(0, 0xffff),

                    // 16 bits for "time_mid"
                    mt_rand(0, 0xffff),

                    // 16 bits for "time_hi_and_version",
                    // four most significant bits holds version number 4
                    mt_rand(0, 0x0fff) | 0x4000,

                    // 16 bits, 8 bits for "clk_seq_hi_res",
                    // 8 bits for "clk_seq_low",
                    // two most significant bits holds zero and one for variant DCE1.1
                    mt_rand(0, 0x3fff) | 0x8000,

                    // 48 bits for "node"
                    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                  );
  }

  public static function v5($namespace, $name)
  {
    if(!self::is_valid($namespace))
      return false;

    // Get hexadecimal components of namespace
    $nhex = str_replace(array('-','{','}'), '', $namespace);

    // Binary Value
    $nstr = '';

    // Convert Namespace UUID to bits
    for($i = 0; $i < strlen($nhex); $i+=2)
    {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    // Calculate hash value
    $hash = sha1($nstr . $name);

    return sprintf('%08s-%04s-%04x-%04x-%12s',

                    // 32 bits for "time_low"
                    substr($hash, 0, 8),

                    // 16 bits for "time_mid"
                    substr($hash, 8, 4),

                    // 16 bits for "time_hi_and_version",
                    // four most significant bits holds version number 5
                    (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,

                    // 16 bits, 8 bits for "clk_seq_hi_res",
                    // 8 bits for "clk_seq_low",
                    // two most significant bits holds zero and one for variant DCE1.1
                    (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

                    // 48 bits for "node"
                    substr($hash, 20, 12)
                  );
  }

  public static function is_valid($uuid)
  {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.'[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
  }

  public function createGUID( $namespace = '' )
  {
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = '{' .   
            substr($hash,  0,  8) . 
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12) .
            '}';
    return $guid;
  }

  public function getSamples()
  {
    // Usage
    // Named-based UUID.
    $v3uuid = $this->v3('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'SomeRandomString');
    $v5uuid = $this->v5('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'SomeRandomString');

    // Pseudo-random UUID

    $v4uuid = $this->v4();

    $guid = $this->createGUID('BuynBrag');

    return array( "v3" => $v3uuid, "v5" => $v5uuid, "v4" => $v4uuid )
  }
}
?>