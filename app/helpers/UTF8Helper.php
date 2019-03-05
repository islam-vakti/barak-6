<?php

class UTF8Helper {

  public static function days($index) {
    $_days = array("Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar");
    return $_days[$index];
  }

  public static function months($index) {
    $_months = array(
      "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
      "Temmuz", "Ağustos", "Eylül", "Ekim ", "Kasım ", "Aralık",
    );
    return $_months[$index];
  }

  public static function strtolower_turkish($string) {
    $lower = array(
      'İ' => 'i', 'I' => 'ı', 'Ğ' => 'ğ', 'Ü' => 'ü',
      'Ş' => 'ş', 'Ö' => 'ö', 'Ç' => 'ç',
    );
    return strtolower(strtr($string, $lower));
  }

  public static function strcmp_turkish($string1, $string2) {
    return self::strtolower_turkish($string1) == self::strtolower_turkish($string2);
  }

  // Kaynak: is_tc(): http://www.kodaman.org/yazi/t-c-kimlik-no-algoritmasi
  public static function is_tc($tc) {
    preg_replace(
      '/([1-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1}).*$/e',
      "eval('
      \$on=((((\\1+\\3+\\5+\\7+\\9)*7)-(\\2+\\4+\\6+\\8))%10);
      \$onbir=(\\1+\\2+\\3+\\4+\\5+\\6+\\7+\\8+\\9+\$on)%10;
      ')",
      $tc
    );
    // ilk üç hane için bir ek kontrol daha
    if (!(isset($on) && isset($onbir))) return false;
    // son iki haneyi (on ve onbirinci) kontrol et
    return substr($tc, -2) == ($on < 0 ? 10 + $on : $on) . $onbir;
  }
}

?>
