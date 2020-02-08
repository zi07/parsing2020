<!-- <meta charset="UTF-8" /> -->
<!-- <%@ page pageEncoding="utf-8"> -->
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-16le"> -->
<!-- <%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%> -->
<!-- <Connector URIEncoding="EUC-KR" connectionTimeout="20000" port="8080" protocol="HTTP/1.1" redirectPort="8443"/> -->
<!-- <meta charset="EUC-KR" /> -->
<!-- <meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> -->
<!-- <%@ page contentType="text/html; charset=euc-kr" %> -->
<?php 
/* 참고 사이트
//촌놈 개발자사이트. post방식 긁어오기
https://infotake.tistory.com/98
//스누피 타사이트 가져올 때 세션 쿠키 등 관련 처리
https://blog.iramine.com/entry/snoopy-%ED%83%80%EC%82%AC%EC%9D%B4%ED%8A%B8-%EA%B0%80%EC%A0%B8%EC%98%A4%EA%B8%B0
//한글이 깨져서 나올때??
https://88240.tistory.com/444
*/
?>

<?php
/*
* include, require 이용시에는 절대-상대경로를 잘 이해 해야 함
* include : 포함 할 파일이 없어도 진행
* include_once : 같은 파일일 여러번 지정 되어도 한번만 로딩 (include 확장)
* require : 포함 할 파일이 없으면 에러
* require_once : 같은 파일일 여러번 지정 되어도 한번만 로딩 (require 확장) - 성향이 있겠으나 막장 개발을 방지 하기 위해서 추천
*/

// include $_SERVER['DOCUMENT_ROOT'].'/lib/Snoopy.class.php';
// include_once 'lib/Snoopy.class.php';
//require($_SERVER['DOCUMENT_ROOT'].'/lib/Snoopy.class.php');
require_once('./Snoopy/Snoopy.class.php');

$snoopy = new Snoopy;
// 헤더값에 따라 403 에러가 발생 할 경우 셋팅
$snoopy->agent = $_SERVER['HTTP_USER_AGENT'];
$snoopy->referer = "http://j123.co.kr";

$snoopy->httpmethod = "POST"; // GET 지정시 GET으로 동작
/* 아래형식으로 배열문 작성하면 먹히질 않는다. 나중에 확인 할 것.
$params = array("pgesize" => "50");
$params = array("resChgPage" => "1");
$params = array("nowPge" => "1");
$params = array("jogun_2" => "y");
$params = array("SDay" => "1");
$params = array("resYear1" => "2020");
$params = array("resMonth1" => "2");
$params = array("resday1" => "7");
$params = array("resYear2" => "2020");
$params = array("resMonth2" => "3");
$params = array("resday2" => "7");

$params = array("AreaSelect" => "1");
$params = array("resSiDo" => "02");
$params = array("resAuctionResult" => "all");
*/
$params["pgesize"] = "50";
$params["resChgPage"] = "1";
$params["nowPge"] = "1";
$params["jogun_2"] = "y";
$params["SDay"] = "1";
$params["resYear1"] = "2020";
$params["resMonth1"] = "2";
$params["resday1"] = "7";
$params["resYear2"] = "2020";
$params["resMonth2"] = "3";
$params["resday2"] = "7";

$params["AreaSelect"] = "1";
$params["resSiDo"] = "02";
$params["resSiGuGun"] = "시흥시";
$params["resSiGuGun"] = iconv("utf8", "euckr", $params["resSiGuGun"]);
$params["resuse"] = "23답";
$params["resuse"] = iconv("utf8", "euckr", $params["resuse"]);

$params["resAuctionResult"] = "all";

$snoopy->fetch('http://www.j123.co.kr/search01/totalsearch.asp');
$snoopy->submit( "http://www.j123.co.kr/search01/totalsearch.asp", $params ); // 한글이 포함될 경우 UTF-8 인코딩 필요

/*
 * 정규식 가져오기 (일부 사이트는 방지가 되어 있을 수 있으니 정규식 지정전에 전체 가져오기를 해보세요)
 */
//preg_match('/<!doctype html>(.*?)<\/html>/is', $snoopy->results, $html);
//echo $html[0];

// 모두 가져오기[GET방식 성공]
$html = $snoopy->results;
$html = iconv("euckr", "utf8", $html);
//$html = iconv("utf8", "euckr", $html);

echo $html;
 

/*
 * 정규식 가져오기 (일부 사이트는 방지가 되어 있을 수 있으니 정규식 지정전에 전체 가져오기를 해보세요)
 
preg_match('/<!doctype html>(.*?)<\/html>/is', $snoopy->results, $html);
echo $html[0];
*/



?>


<?php
/*
include 'Snoopy.class.php'; 
$snoopy = new snoopy; 
$url = "http://www.j123.co.kr/search01/totalsearch.asp";//파싱할게시판주소(https인경우 http로 해주셔야됩니다)
$snoopy -> referer = "http://www.j123.co.kr"; // 리퍼러 주소
//$snoopy -> fetch($url);

//form전송을 해야 한다면
$snoopy->httpmethod = "POST";
$params = array("pgesize" => "100");
$params = array("resChgPage" => "1");
$params = array("jogun_2" => "y");
$params = array("SDay" => "1");
$params = array("resYear1" => "2020");
$params = array("resMonth1" => "2");
$params = array("resday1" => "7");
$params = array("resYear2" => "2020");
$params = array("resMonth2" => "3");
$params = array("resday2" => "7");

$params = array("resAuctionResult" => "all");
$params = array("AreaSelect" => "1");
$params = array("resSiDo" => "02");

/*
$vars['pgesize'] = '100';
$vars['resChgPage'] = '1';
$vars['jogun_2'] = 'y';
$vars['SDay'] = '1';
$vars['resYear1'] = '2020';
$vars['resMonth1'] = '2';
$vars['resday1'] = '7';
$vars['resYear2'] = '2020';
$vars['resMonth2'] = '3';
$vars['resday2'] = '7';

$vars['resAuctionResult'] = 'all';
$vars['AreaSelect'] = '1';
$vars['resSiDo'] = '02';


$submit_url = 'http://www.j123.co.kr/search01/totalsearch.asp'; //폼이 전송될 주소를 정해줍니다.
//$snoopy -> fetch($url); 대신에
$snoopy -> submit($submit_url, $params); // 이 구문을 이용합니다.

for($i = 1 ; $i <=100 ; $i++){
echo $params[$i];}

//그러면 $snoopy -> results에 전송결과가 담겨집니다.
/*
$endtext=explode('<title>',$snoopy->results);//파싱할 마지막부분
$starttext=explode('</title>',$endtext[0]);//파싱할 첫번째부분

//$ex = iconv("utf8", "euckr", $ex);

//print $snoopy->results;
//echo $starttext[0];//파싱된내용확인

preg_match('<form>', $snoopy->results, $html);
for($i = 1 ; $i <=12 ; $i++){
echo $html[$i];}
	
//추출된 $starttext[1] 이값에서 또 원하는 값을 뽑으려면 explode나 preg_match, 등등으로 응용하셔서 원하시는 값을 뽑을수 있습니다.
//공부용으로 하시고 이걸 응용하면 많은 도움이 되실겁니다.
//예를 들어서 아미나보드의 경우 글읽기에서 보면 첫번째부분에 <div class="view-wrap"> 마지막부분에 <div class="print-hide view-good-box">
//이걸넣어주면 게시글이 파싱되고 이분에서 원하시는 값을 뽑아서 넣어주면 되겠죠. 큰따옴표"앞에는 \를 넣어줘야 됩니다.

*/
?>


























