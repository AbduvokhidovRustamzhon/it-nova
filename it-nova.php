<?php

/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

$url = 'https://www.facebook.com'

$html = file_get_contents($url); // получаем контент страницы

$str = strip_tags($html); // Берем контент из сайта и удаляем HTML & PHP теги


echo strip_tags($str, '<p>');  //Получаем текст произвольной страницы



/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

// выводим заголовок страницы

preg_match_all("#.*<title>(.+)<\/title>.*#isU", $html, $titles);
echo $titles[1][0];


/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

// получаем url-ы страницы и выводим их всех

preg_match_all("/<[Aa][\s]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\s]*([^ \"'>\s#]+)[^>]*>/", $html, $matches);

$urls = $matches[1];

for ($i = 0; $i < count($urls); $i++){

    echo "\n";

    echo $urls[$i]; 

}


/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/


// общая функия для генерирование hash сумм SHA512 любой строки

function hashSha512($hash){
    $sha512 = hash('sha512', $hash);
    
    echo $sha512;
    }


/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

// общая функция для соединения url-ов через некий период 

function trimUrls($urls, $period){

    $trimUrls = $urls[0];

    for ($i = 0; $i < count($urls); $i=$i+$period){
    
        $urls[$i] = $trimUrls;
        
        $trimUrls = $urls[$i].$urls[$i+$period];
        
    }
    
    echo $trimUrls;
}


/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

// общая функия для генерирование hash сумм MD5 любой строки

function hashMD5($string){
    $hash = md5($string);
    echo $hash;
}

/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

// общая функия для генерирование hash сумм SHA1 любой строки

function hashSha1($hash){  // генерировать hash сумму SHA512
    
    $sha1 = hash('sha1', $hash);
    
    echo $sha1;

    }

/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

$sumHashSHA512 = hashSha512($str);  // генерирование hash суммы SHA512 из всего текста страницы
echo $sumHashSHA512;

$sumHashSHA512TrimUrls = hashSha512(trimUrls($urls, 1)); // генерирование hash суммы SHA512 url-ов соединенных воедино 
echo $sumHashSHA512TrimUrls;

$sumHashMD5TrimUrls = hashMD5(trimUrls($urls, 3)); // генерирование hash суммы SHA512 url-ов соединённых в одну строку каждого 3-го линка
echo $sumHashMD5TrimUrls;


// генерирование hash суммы SHA1 из всех ранее сгенерированных hash сумм
echo hashSha1($sumHashMD5TrimUrls);  

echo hashSha1($sumHashSHA512);

echo hashSha1($sumHashSHA512TrimUrls);

?>