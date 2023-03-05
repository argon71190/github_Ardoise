<?php

namespace Models;

class arrayCodeBarre {

    public function getArray() {
        // Tableaux des références pour la génération des codes barres
            $tab = array();	     $tab2 = array();     $tab3 = array();
            $tab[0]='212222';    $tab2[0]='£';        $tab3['£']=0;
            $tab[1]='222122';    $tab2[1]='!';        $tab3['!']=1;
            $tab[2]='222221';    $tab2[2]='"';        $tab3['"']=2;
            $tab[3]='121223';    $tab2[3]='#';        $tab3['#']=3;
            $tab[4]='121322';    $tab2[4]='$';        $tab3['$']=4;
            $tab[5]='131222';    $tab2[5]='%';        $tab3['%']=5;
            $tab[6]='122213';    $tab2[6]='&';        $tab3['&']=6;
            $tab[7]='122312';    $tab2[7]="'";        $tab3["'"]=7;
            $tab[8]='132212';    $tab2[8]='(';        $tab3['(']=8;
            $tab[9]='221213';    $tab2[9]=')';        $tab3[')']=9;
            $tab[10]='221312';   $tab2[10]='*';       $tab3['*']=10;
            $tab[11]='231212';   $tab2[11]='+';       $tab3['+']=11;
            $tab[12]='112232';   $tab2[12]=',';       $tab3[',']=12;
            $tab[13]='122132';   $tab2[13]='-';       $tab3['-']=13;
            $tab[14]='122231';   $tab2[14]='.';       $tab3['.']=14;
            $tab[15]='113222';   $tab2[15]='/';       $tab3['/']=15;
            $tab[16]='123122';   $tab2[16]='0';       $tab3['0']=16;
            $tab[17]='123221';   $tab2[17]='1';       $tab3['1']=17;
            $tab[18]='223211';   $tab2[18]='2';       $tab3['2']=18;
            $tab[19]='221132';   $tab2[19]='3';       $tab3['3']=19;
            $tab[20]='221231';   $tab2[20]='4';       $tab3['4']=20;
            $tab[21]='213212';   $tab2[21]='5';       $tab3['5']=21;
            $tab[22]='223112';   $tab2[22]='6';       $tab3['6']=22;
            $tab[23]='312131';   $tab2[23]='7';       $tab3['7']=23;
            $tab[24]='311222';   $tab2[24]='8';       $tab3['8']=24;
            $tab[25]='321122';   $tab2[25]='9';       $tab3['9']=25;
            $tab[26]='321221';   $tab2[26]=':';       $tab3[':']=26;
            $tab[27]='312212';   $tab2[27]=';';       $tab3[';']=27;
            $tab[28]='322112';   $tab2[28]='<';       $tab3['<']=28;
            $tab[29]='322211';   $tab2[29]='=';       $tab3['=']=29;
            $tab[30]='212123';   $tab2[30]='>';       $tab3['>']=30;
            $tab[31]='212321';   $tab2[31]='?';       $tab3['?']=31;
            $tab[32]='232121';   $tab2[32]='@';       $tab3['@']=32;
            $tab[33]='111323';   $tab2[33]='A';       $tab3['A']=33;
            $tab[34]='131123';   $tab2[34]='B';       $tab3['B']=34;
            $tab[35]='131321';   $tab2[35]='C';       $tab3['C']=35;
            $tab[36]='112313';   $tab2[36]='D';       $tab3['D']=36;
            $tab[37]='132113';   $tab2[37]='E';       $tab3['E']=37;
            $tab[38]='132311';   $tab2[38]='F';       $tab3['F']=38;
            $tab[39]='211313';   $tab2[39]='G';       $tab3['G']=39;
            $tab[40]='231113';   $tab2[40]='H';       $tab3['H']=40;
            $tab[41]='231311';   $tab2[41]='I';       $tab3['I']=41;
            $tab[42]='112133';   $tab2[42]='J';       $tab3['J']=42;
            $tab[43]='112331';   $tab2[43]='K';       $tab3['K']=43;
            $tab[44]='132131';   $tab2[44]='L';       $tab3['L']=44;
            $tab[45]='113123';   $tab2[45]='M';       $tab3['M']=45;
            $tab[46]='113321';   $tab2[46]='N';       $tab3['N']=46;
            $tab[47]='133121';   $tab2[47]='O';       $tab3['O']=47;
            $tab[48]='313121';   $tab2[48]='P';       $tab3['P']=48;
            $tab[49]='211331';   $tab2[49]='Q';       $tab3['Q']=49;
            $tab[50]='231131';   $tab2[50]='R';       $tab3['R']=50;
            $tab[51]='213113';   $tab2[51]='S';       $tab3['S']=51;
            $tab[52]='213311';   $tab2[52]='T';       $tab3['T']=52;
            $tab[53]='213131';   $tab2[53]='U';       $tab3['U']=53;
            $tab[54]='311123';   $tab2[54]='V';       $tab3['V']=54;
            $tab[55]='311321';   $tab2[55]='W';       $tab3['W']=55;
            $tab[56]='331121';   $tab2[56]='X';       $tab3['X']=56;
            $tab[57]='312113';   $tab2[57]='Y';       $tab3['Y']=57;
            $tab[58]='312311';   $tab2[58]='Z';       $tab3['Z']=58;
            $tab[59]='332111';   $tab2[59]='[';       $tab3['[']=59;
            $tab[60]='314111';   $tab2[60]='\\';      $tab3['\\']=60;
            $tab[61]='221411';   $tab2[61]=']';       $tab3[']']=61;
            $tab[62]='431111';   $tab2[62]='^';       $tab3['^']=62;
            $tab[63]='111224';   $tab2[63]='_';       $tab3['_']=63;
            $tab[64]='111422';   $tab2[64]='`';       $tab3['`']=64;
            $tab[65]='121124';   $tab2[65]='a';       $tab3['a']=65;
            $tab[66]='121421';   $tab2[66]='b';       $tab3['b']=66;
            $tab[67]='141122';   $tab2[67]='c';       $tab3['c']=67;
            $tab[68]='141221';   $tab2[68]='d';       $tab3['d']=68;
            $tab[69]='112214';   $tab2[69]='e';       $tab3['e']=69;
            $tab[70]='112412';   $tab2[70]='f';       $tab3['f']=70;
            $tab[71]='122114';   $tab2[71]='g';       $tab3['g']=71;
            $tab[72]='122411';   $tab2[72]='h';       $tab3['h']=72;
            $tab[73]='142112';   $tab2[73]='i';       $tab3['i']=73;
            $tab[74]='142211';   $tab2[74]='j';       $tab3['j']=74;
            $tab[75]='241211';   $tab2[75]='k';       $tab3['k']=75;
            $tab[76]='221114';   $tab2[76]='l';       $tab3['l']=76;
            $tab[77]='413111';   $tab2[77]='m';       $tab3['m']=77;
            $tab[78]='241112';   $tab2[78]='n';       $tab3['n']=78;
            $tab[79]='134111';   $tab2[79]='o';       $tab3['o']=79;
            $tab[80]='111242';   $tab2[80]='p';       $tab3['p']=80;
            $tab[81]='121142';   $tab2[81]='q';       $tab3['q']=81;
            $tab[82]='121241';   $tab2[82]='r';       $tab3['r']=82;
            $tab[83]='114212';   $tab2[83]='s';       $tab3['s']=83;
            $tab[84]='124112';   $tab2[84]='t';       $tab3['t']=84;
            $tab[85]='124211';   $tab2[85]='u';       $tab3['u']=85;
            $tab[86]='411212';   $tab2[86]='v';       $tab3['v']=86;
            $tab[87]='421112';   $tab2[87]='w';       $tab3['w']=87;
            $tab[88]='421211';   $tab2[88]='x';       $tab3['x']=88;
            $tab[89]='212141';   $tab2[89]='y';       $tab3['y']=89;
            $tab[90]='214121';   $tab2[90]='z';       $tab3['z']=90;
            $tab[91]='412121';   $tab2[91]='{';       $tab3['{']=91;
            $tab[92]='111143';   $tab2[92]='|';       $tab3['|']=92;
            $tab[93]='111341';   $tab2[93]='}';       $tab3['}']=93;
            $tab[94]='131141';   $tab2[94]='~';       $tab3['~']=94;
            $tab[95]='114113';   $tab2[95]='del';     $tab3['del']=95;
            $tab[96]='114311';   $tab2[96]='fnc3';    $tab3['fnc3']=96;
            $tab[97]='411113';   $tab2[97]='fnc2';    $tab3['fnc2']=97;
            $tab[98]='411311';   $tab2[98]='shift';   $tab3['shift']=98;
            $tab[99]='113141';   $tab2[99]='codec';   $tab3['codec']=99;
            $tab[100]='114131';  $tab2[100]='fnc4';   $tab3['fnc4']=100;
            $tab[101]='311141';  $tab2[101]='codea';  $tab3['codea']=101;
            $tab[102]='411131';  $tab2[102]='fnc1';   $tab3['fnc1']=102;
            $tab[103]='211412';  $tab2[103]='starta'; $tab3['starta']=103;
            $tab[104]='211214';  $tab2[104]='startb'; $tab3['startb']=104;
            $tab[105]='211232';  $tab2[105]='startc'; $tab3['startc']=105;
            $tab[106]='2331112'; $tab2[106]='stop';   $tab3['stop']=106;

        return [$tab, $tab2, $tab3];
    }
}