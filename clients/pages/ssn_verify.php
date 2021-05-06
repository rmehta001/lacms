<?php
//  
//  [ssn_verify] v1.0
//  Copyright(c) 2004 Josh L. Reznick
//  email: jrez(at)jrez.com
//
//  [ssn_verify] determines whether or not a particular Social Security Number
//  has been issued by the Social Security Administration based on their
//  (bizzare) sequence of number issuance.  It also checks for known bogus
//  numbers, such as ones that havebeen used in advertising.  Please see below 
//  for information on how to update the SSN issuance data based on the SSA's
//  Monthly Issuance Table.
//
//  [ssn_verify] is free software; you can redistribute it and/or modify
//  it under the terms of the GNU Lesser General Public License as published by
//  the Free Software Foundation; either version 2.1 of the License, or
//  (at your option) any later version.
//
//  [ssn_verify] is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU Lesser General Public License for more details.
//
//  If you do find this script useful, please drop me an email.  I am very 
//  interested to know the various uses people have for this functionality.
//  Thanks!
//
//  -------------------------------------------------------------------------
//
//  The data below is taken from the November 2004 SSA Monthly Issuance Table.
//  You can update the data at any time by simply cutting and pasting the data
//  found at http://www.ssa.gov/employer/highgroup.txt into the variable below.
//
//  NOTE: Chances are you will only be using this function to validate adult
//  SSN's-  If that is the case, then you have a good 18 years before there are
//  any adults with SSNs that are not included in the data below.
//

$ssn_data = "
001 06  002 06	003 06	004 08	005 08	006 08
007 08	008 92	009 90  010 92  011 92  012 92*
013 90	014 90	015 90	016 90	017 90	018 90
019 90	020 90	021 90	022 90	023 90	024 90
025 90	026 90	027 90	028 90 	029 90	030 90
031 90	032 90	033 90	034 90	035 72	036 72
037 72  038 72	039 72	040 13	041 13  042 13
043 11	044 11	045 11	046 11	047 11	048 11 
049 11	050 98	051 98	052 98	053 98	054 98
055 98	056 98	057 98	058 98	059 98* 060 98* 
061 98* 062 98* 063 96  064 96  065 96	066 96
067 96	068 96	069 96	070 96	071 96	072 96
073 96	074 96	075 96	076 96	077 96	078 96
079 96	080 96	081 96	082 96	083 96	084 96
085 96	086 96	087 96	088 96	089 96	090 96
091 96	092 96	093 96	094 96	095 96	096 96
097 96	098 96	099 96	100 96	101 96	102 96
103 96	104 96	105 96	106 96	107 96	108 96
109 96	110 96	111 96	112 96	113 96  114 96 
115 96  116 96  117 96  118 96  119 96	120 96
121 96	122 96	123 96	124 96	125 96	126 96 
127 96  128 96	129 96	130 96	131 96	132 96
133 96	134 96	135 19	136 19	137 19	138 19
139 19	140 19	141 19	142 19  143 19	144 19 
145 19 	146 19	147 19	148 19	149 19	150 19
151 19	152 19	153 19	154 19  155 19	156 19
157 19	158 19*	159 84	160 84	161 84	162 84
163 84	164 84	165 84	166 84	167 84	168 84
169 84	170 84	171 84	172 84	173 84	174 84
175 84	176 84	177 84	178 84	179 84	180 84 
181 84 	182 84	183 84	184 84	185 84	186 84
187 84	188 84	189 84	190 84	191 84	192 84
193 84	194 84*	195 84* 196 82	197 82	198 82
199 82 	200 82	201 82	202 82	203 82	204 82
205 82	206 82	207 82	208 82	209 82	210 82
211 82	212 81	213 81	214 81	215 81	216 81 
217 81	218 81	219 81*	220 79	221 06	222 06
223 99	224 99  225 99  226 99  227 99	228 99
229 99	230 99	231 99	232 55	233 55	234 53
235 53	236 53	237 99	238 99	239 99	240 99
241 99	242 99	243 99  244 99  245 99	246 99
247 99	248 99	249 99	250 99	251 99	252 99
253 99	254 99	255 99	256 99	257 99	258 99
259 99	260 99	261 99	262 99	263 99	264 99
265 99	266 99	267 99	268 13	269 13	270 13
271 13 	272 13 	273 13	274 13	275 13	276 13
277 13	278 13	279 13	280 13	281 13	282 13
283 13	284 13	285 13	286 13  287 13	288 13
289 13	290 13	291 13	292 13	293 13	294 13
295 13	296 13	297 13	298 13	299 13*	300 13*
301 11	302 11	303 33	304 33	305 33	306 33
307 33	308 33	309 33	310 33	311 33	312 31
313 31	314 31  315 31	316 31	317 31	318 08
319 08	320 08	321 08	322 08	323 08*	324 08*
325 06	326 06	327 06	328 06	329 06	330 06 
331 06 	332 06	333 06	334 06  335 06  336 06
337 06	338 06	339 06	340 06	341 06	342 06
343 06	344 06	345 06	346 06	347 06	348 06
349 06 	350 06 	351 06	352 06	353 06	354 06
355 06	356 06	357 06	358 06	359 06	360 06
361 06	362 35	363 35	364 35	365 35 	366 35
367 35	368 35	369 35	370 35	371 35	372 35
373 35	374 35	375 35*	376 35*	377 33 	378 33 
379 33	380 33	381 33	382 33	383 33	384 33
385 33	386 33  387 29	388 29	389 29	390 29
391 29	392 29	393 29  394 29	395 29	396 29
397 29	398 29	399 29	400 69	401 69	402 69  
403 69	404 67	405 67	406 67	407 67	408 99
409 99	410 99	411 99  412 99	413 99	414 99
415 99	416 63 	417 63	418 63	419 63	420 63
421 63	422 61	423 61	424 61	425 99	426 99
427 99	428 99	429 99	430 99	431 99	432 99
433 99	434 99	435 99	436 99	437 99	438 99
439 99  440 25	441 25	442 25*	443 23	444 23
445 23	446 23	447 23	448 23	449 99	450 99
451 99	452 99	453 99	454 99	455 99	456 99
457 99	458 99	459 99	460 99	461 99	462 99
463 99	464 99	465 99	466 99	467 99	468 51
469 51	470 51 	471 51	472 51	473 51	474 51
475 51	476 51	477 51*	478 39	479 39	480 39
481 37  482 37	483 37	484 37	485 37	486 27
487 27	488 27*	489 25	490 25	491 25	492 25
493 25	494 25	495 25	496 25 	497 25	498 25
499 25  500 25	501 33	502 33	503 41  504 41 
505 53	506 53	507 53	508 53*	509 29	510 29
511 29	512 29*	513 27  514 27	515 27	516 45
517 45	518 81*	519 79  520 55  521 99	522 99
523 99	524 99	525 99	526 99	527 99	528 99
529 99	530 99	531 65*	532 63 	533 63	534 63
535 63  536 63	537 63	538 63  539 63	540 75 
541 75  542 75	543 75	544 75	545 99	546 99
547 99	548 99	549 99	550 99	551 99	552 99
553 99	554 99	555 99	556 99	557 99	558 99
559 99	560 99	561 99	562 99	563 99	564 99
565 99	566 99	567 99	568 99	569 99	570 99
571 99	572 99	573 99	574 53*	575 99	576 99
577 47	578 47* 579 45	580 39	581 99	582 99
583 99	584 99	585 99	586 63*	587 99  588 03
589 99  590 99	591 99	592 99	593 99  594 99  
595 99  596 86	597 86	598 86*	599 84	600 99	
601 99  602 71*	603 71*	604 71*	605 71*	606 71*	
607 71* 608 69	609 69	610 69	611 69	612 69	
613 69  614 69	615 69	616 69	617 69	618 69	
619 69  620 69	621 69	622 69	623 69	624 69 	
625 69  626 69*	627 15	628 15	629 15	630 15	
631 15  632 15	633 15	634 15	635 15  636 15 	
637 15  638 15*	639 15*	640 15* 641 15*	642 13	
643 13  644 13	645 13	646 04* 647 02	648 48	
649 46  650 50  651 50*	652 48  653 48	654 30*	
655 28  656 28	657 28	658 28	659 18* 660 16  
661 16  662 16  663 16  664 16	665 16	667 38  
668 38  669 38* 670 38*	671 38*	672 36	673 36	
674 36  675 36  676 16	677 16*	678 14  679 14
680 98  681 16  682 16  683 16  684 16*	685 16* 	
686 14  687 14	688 14	689 14	690 14	691 10*  
692 10* 693 09  694 09  695 09  696 09  697 09 
698 09  699 09  700 18	701 18  702 18  703 18  
704 18  705 18  706 18	707 18  708 18  709 18  
710 18  711 18	712 18	713 18  714 18  715 18  
716 18  717 18	718 18	719 18  720 18  721 18  
722 18  723 18	724 28	725 18  726 18  727 10	
728 14  729 14	730 14	731 12  732 12	733 12	
750 10  751 10	752 03  753 03  754 01	755 01
756 07  757 07	758 07  759 07  760 05  761 05	
762 05  763 05	764 92* 765 90	766 72  767 72
768 72  769 72*	770 72* 771 72* 772 70	
";

$known_bogus = array(111111111, 222222222, 333333333, 444444444, 555555555,
                     666666666, 777777777, 888888888, 999999999, 000000000,
                     123456789, 987654321, 121212121, 101010101, 010101010,
                    // 002281852, 042103580, 062360749, 078051120, 095073645,
                     128036045, 135016629, 141186941, 165167999, 165187999, 
                     165207999, 165227999, 165247999, 189092294, 212097694, 
                     212099999, 306302348, 308125070, 468288779, 549241889);
										  

function getLevelSSN($num) {
  if ( ($num<10) && (($num%2)==1) ) $level=1;
  //if ( ($num>09) && (($num%2)==0) ) $level=2;
  if ( ($num<10) && (($num%2)==0) ) $level=3;
 // if ( ($num>09) && (($num%2)==1) ) $level=4;
  return $level;
}

function isValidSSN($ssn) {
  global $ssn_data,$known_bogus;
	$ssn = str_replace("-","",$ssn);
	$area = intval(substr($ssn,0,3));
  $group = intval(substr($ssn,3,2));
	$serial = intval(substr($ssn,5,4));
  preg_match_all("/(\d{3} \d{2})/", $ssn_data, $results, PREG_SET_ORDER);
  for($i=0;$i<sizeof($results);$i++) {
    list($area_temp,$group_temp) = explode(" ",$results[$i][1]);
	  $group_val[$area_temp] = $group_temp;
  }
  $high = $group_val[$area];
  $group_level = getLevelSSN($group);
  $high_level = getLevelSSN($high);
  if ($group_level<$high_level) $pass=true;
	if ( ($group_level==$high_level) && ($group<=$high) ) $pass=true; 
  if ( ($area==0) || ($group==0) || ($serial==0) ) $pass=false;
	if ( ($area==666) || ( ($area>699) && ($area<729) ) || ($area>899) ) $pass=false;
	if ( (strlen($ssn)!=9) || (!is_numeric($ssn)) ) $pass=false;
	for($i=0;$i<sizeof($known_bogus);$i++) if (intval($ssn)==$known_bogus[$i]) $pass=false;
	return $pass;
}


?>
