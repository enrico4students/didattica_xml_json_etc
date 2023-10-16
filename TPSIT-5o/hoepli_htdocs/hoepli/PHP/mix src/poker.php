<?php
//session_start();

//$valori=array('2','3','4','5','6','7','8','9','10','j','q','k','a');
$semi=array('c','q','f','p');
$mazzo=array();
$ngioc=4;
$punt=0;


function creamazzo()
	{
		$valori=array('2','3','4','5','6','7','8','9','10','11','12','13','14');
        global $semi;
		$ncarta=0;
		for($seme=0;$seme<4;$seme++)
		{
			for($val=0; $val<count($valori); $val++)
			{
			$mazzo[$ncarta]['val']=$valori[$val];
			$mazzo[$ncarta]['seme']=$semi[$seme];
			$mazzo[$ncarta]['cop']=true; //coperta o no, x visualizz.
			$mazzo[$ncarta]['pos']='mazzo'; //  la carta è nel  mazzo/tavolo/1/2..gn
			$mazzo[$ncarta]['img']='<img src="carte/back.gif">';
			$ncarta++;
			}
		
		}
	return $mazzo;
	}
	
function daicarte($mazzo,$ncarte)
	{
	global $punt;
	global $ngioc;
	$numcarta=$punt;
	for($i=1; $i<=$ncarte; $i++)
		{
			for($n=1; $n<=$ngioc; $n++)
			{
				$mazzo[$numcarta]['pos']=$n;
				if($n==1)
				{
					$mazzo[$numcarta]['cop']=false;
					$mazzo[$numcarta]['img']='<img src="carte/'.$mazzo[$numcarta]['val'].$mazzo[$numcarta]['seme'].'.gif">';
				}
				//var_dump($mazzo[$numcarta]); echo "<br>";
				$numcarta++;
			}
		
		}
	$punt=$numcarta;
	return $mazzo;	
	}
	
function cartesutavolo($mazzo,$ncarte)
	{
	global $punt;
	$numcarta=$punt;
	for($i=1; $i<=$ncarte; $i++)
		{
			$mazzo[$numcarta]['pos']='tavolo';
			$mazzo[$numcarta]['cop']=false;
			$mazzo[$numcarta]['img']='<img src="carte/'.$mazzo[$numcarta]['val'].$mazzo[$numcarta]['seme'].'.gif">';
			$numcarta++;
		}
	$punt=$numcarta;
	return $mazzo;	
	}
	
function stampa($mazzo)
	{
		global $punt;
		global $ngioc;
		$str='POKER<BR> <table bgcolor="green"  cellpadding="10" cellspacing="10">';
		$str.='<tr><td>MAZZO<BR>'.$mazzo[$punt]['img'].'</td>';
		$str.='<td colspan="3">TAVOLO<BR>';
		for($i=0; $i<count($mazzo); $i++)
			{
				if($mazzo[$i]['pos']=='tavolo')
					{
						$str.=$mazzo[$i]['img'];
					}
			}
		$str.='</td></tr><tr>';
		for($gioc=1; $gioc<=$ngioc; $gioc++) //per ogni giocatore
			{
				$str.='<td>GIOCATORE '.$gioc.'<br>';
				for($i=0; $i<count($mazzo); $i++)
					{
						if($mazzo[$i]['pos']==$gioc)
							{
								$str.=$mazzo[$i]['img'];
							}
					}
				$str.='</td>';
			}
		
		$str.='</tr></table>';
		echo($str);
	} 	

function scopricarte($mazzo)
	{
	for($i=0; $i<count($mazzo); $i++)
		{
			if(($mazzo[$i]['pos']!='mazzo')and($mazzo[$i]['pos']!='tavolo'))
			{
				$mazzo[$i]['cop']=false;
				$mazzo[$i]['img']='<img src="carte/'.$mazzo[$i]['val'].$mazzo[$i]['seme'].'.gif">';
			}
		}

	return $mazzo;	
	}
	

function cartegioc($gioc,$mazzo)
	{
	$carte=NULL;
	$num=0;
		for($i=0; $i<count($mazzo); $i++)
			{
				if(($mazzo[$i]['pos']==$gioc)or($mazzo[$i]['pos']=='tavolo'))
					{
						$carte[$num]=$mazzo[$i];
						$num++;
					}
			
			}
	//var_dump($carte);
	return $carte;
	
	}

function scalareale($carte,$gioc)
	{
		$s=false;
		$dim=count($carte)-1;
		if(($carte[$dim]=='14')and($carte[$dim-1]=='13')and($carte[$dim-2]=='12')and($carte[$dim-3]=='11')and($carte[$dim-4]=='10'))	
			{
				echo($gioc.' Scala reale');
				$s=true;
			}
	if($s){return 'scala reale';}else{return'';}
	}
	
function scaladicolore($carte,$gioc)
	{
		$s=false;
		$dim=count($carte)-1;
		if(($carte[$dim]==$carte[$dim-1]+1)and($carte[$dim-1]==$carte[$dim-2]+1)and($carte[$dim-2]==$carte[$dim-3]+1)and($carte[$dim-3]==$carte[$dim-4]+1))
			{
				echo($gioc.' Scala di colore');
				$s=true;
			}
	if($s){return 'scala di colore';}else{return'';}
	}

function separaperseme($carte,$gioc) //separo carte del giocatore per seme
	{
	 global $semi;
	 $ris='';
		for($seme=0; $seme<count($semi); $seme++)//creo un array per ogni seme
		{	
			$pos=0; 
			$semex=NULL;
			for($i=0; $i<count($carte);$i++) //per ogni carta
				{
					if($carte[$i]['seme']==$semi[$seme])
						{
							$semex[$pos]=$carte[$i]['val'];
							$pos++;
						}
				}
		if($semex!=NULL){sort($semex);}
		
		if(count($semex)>=5)
			{   
				$ris='';
				$ris=scalareale($semex,$gioc);
				if($ris==''){$ris=scaladicolore($semex,$gioc);}
				if($ris==''){$ris='colore';}
				
			}
		
		//var_dump($semex); echo"<br>";
		}
		return $ris;
	}	
	
	
function solovalori($carte)
	{
		$solovalore=NULL;
		for($i=0; $i<count($carte);$i++) //per ogni carta
				{
					$solovalore[$i]=$carte[$i]['val'];
				}
		sort($solovalore);
	return $solovalore;
	}

function pokerr($valori) //4 valori uguali in_array() 
	{
		$p=false;
		$str=','.implode(",",$valori).',';
		for($i=0; $i<count($valori);$i++)
			{
				$num=substr_count($str,','.$valori[$i]);
				if(($num==4)and($p==false))//poker
					{
						//echo(" poker ");
						$p=true;
					}
			}
		if($p){return 'poker';}else{return'';}
	}	

function full($valori) //3+2
	{
		$t=false;//tris e coppia
		$c=false;
		$str=','.implode(",",$valori).',';
		for($i=0; $i<count($valori);$i++)
			{
				$num=substr_count($str,','.$valori[$i]);
				if(($num==3)and($t==false))//tris
					{
						$t=true;
						for($k=0; $k<count($valori);$k++)
							{
								$num=substr_count($str,','.$valori[$k]);
								if(($num==2)and($c==false))//coppia
									{
										$c=true;
										//echo(" full ");
									}
							}
						
					}
			}
		if($c){return 'full';}else{return'';}
	}	

function tris($valori) //3 valori uguali in_array() 
	{
		$t=false;
		$str=','.implode(",",$valori).',';
		for($i=0; $i<count($valori);$i++)
			{
				$cerca=','.$valori[$i];
				$num=substr_count($str,$cerca);
				if(($num==3)and($t==false))
					{
						//echo(" tris ");
						$t=true;
					}
			}
		if($t){return 'tris';}else{return'';}
	}	

function coppia($valori) //2 valori uguali in_array() 
	{
		$t=false;
		$str=','.implode(",",$valori).',';
		for($i=0; $i<count($valori);$i++)
			{
				$num=substr_count($str,','.$valori[$i]);
				if(($num==2)and($t==false))
					{
						//echo(" coppia ");
						$t=true;
					}
			}
		if($t){return 'coppia';}else{return'';}
	}	

function doppiacoppia($valori)
	{
		$dc=false;
		$c=0;
		$coppiaprec='';
		$str=','.implode(",",$valori).',';
		for($i=0; $i<count($valori);$i++) //per ogni carta
			{
				$num=substr_count($str,','.$valori[$i]);
				if(($num==2)and($c<2)and($coppiaprec<>$valori[$i]))
					{
						$coppiaprec=$valori[$i];
						$c++;
					}
			}
		if($c==2){$dc=true;}
		if($dc){return 'doppia coppia';}else{return'';}
	}		
	
function controllovalori($valori)
	{
		$ris='';
		$ris=pokerr($valori);
		if($ris==''){$ris=full($valori);}
		if($ris==''){$ris=tris($valori);}
		if($ris==''){$ris=doppiacoppia($valori);}
		if($ris==''){$ris=coppia($valori);}
		if($ris==''){$ris='carta singola';}
		//echo($ris);
	return $ris;
	
	
	}



function risultati($mazzo)
	{
	global $ngioc;
	$importanza=array('scala reale','scala di colore','poker','full','colore','scala','tris','doppia coppia','coppia','carta singola','');
	$risultato_giocatore=NULL;	
		for($gioc=1; $gioc<=$ngioc; $gioc++) //per ogni giocatore
			{
				//salvo le sue carte in un array e lo ordino
				$carte=cartegioc($gioc,$mazzo);
				
				$colore=separaperseme($carte,$gioc); //
				$valori=solovalori($carte); //array 0->6
				//var_dump($valori);
				$scale=controllovalori($valori);  //
				
				$var1=array_search($colore,$importanza); //importanza colore
				$var2=array_search($scale,$importanza);	//importanza scala
				if($var1<$var2){$risultato_giocatore[$gioc]=$var1;}else{$risultato_giocatore[$gioc]=$var2;}
				echo('GIOCATORE '.$gioc.': '.$importanza[$risultato_giocatore[$gioc]].'<BR>');		
			}
	asort($risultato_giocatore);
	//var_dump($risultato_giocatore);
	$chiavi=NULL;
	for($gioc=1; $gioc<=$ngioc; $gioc++) //per ogni giocatore
		{$chiavi=array_keys($risultato_giocatore);}
	//var_dump($chiavi);
	echo('VINCE IL GIOCATORE '.$chiavi[0]);
	
	
	}
	
  
  $mazzo=creamazzo();
  shuffle($mazzo);
  $mazzo=daicarte($mazzo,2);//mazzo, numerodigiocatori, carteciascuno
  $mazzo=cartesutavolo($mazzo,5);//mazzo, quante sul tavolo
  $mazzo=scopricarte($mazzo);
  stampa($mazzo);
  risultati($mazzo);

?>