<?php/*****************************************************************************************	H selida auth parexei tis epiloges gia diagrafh 'h kai pros8hkh kapoias kathgorias*****************************************************************************************///including required filesinclude('includes.php');//elegxoume an o xrhsths einai swsta sundedemenoscheck_valid_user();//kataxwroume thn SESSION metavlhth newCat se mia topikh metavlhth $newCatif(isset($_POST['newCat'])) $newCat=$_POST['newCat']; else $newCat=NULL;//kataxwroume thn SESSION metavlhth category se mia topikh metavlhth $categoryif(isset($_POST['category'])) $delCat=$_POST['category']; else $delCat=NULL;try{	//elegxoume an to checkbox gia thn diagrafh kathgoriwn einai markarismeno	if(filledOut($delCat))	{		dispHeader('Diagrafh kathgoriwn');		//an nai diagrafoume mia mia tis kathgories		foreach($delCat as $cat)		{			echo "$cat <br />";			db_del_cat($cat);		}		dispFooter();	}	//elegxoume an o xrhsths evale mia kainourgia kathgoria	else if(filledOut($newCat))	{		//an nai eisagoume thn kathgoria sthn vash		$newCat=$_POST['newCat'];		//me auth thn sunarthsh eisagoume thn kathgoria sth vash		db_insert1('categories','category',"'$newCat'");		dispHeader("Kainourgia kathgoria $newCat");		//H sunarthsh dispCategoriesSettings() emfanizei to menu epilogwn gia thn diagrafh 'h kai pros8hkh kathgoriwn		dispCategoriesSettings();		dispFooter();	}	//an den einai tipota epilegmeno tote apla emfanizoume to menu epilogwn	else	{		dispHeader('Oi uparxouses kathgories');		//H sunarthsh dispCategoriesSettings() emfanizei to menu epilogwn gia thn diagrafh 'h kai pros8hkh kathgoriwn		dispCategoriesSettings();		dispFooter();	}}catch(Exception $e){	dispHeader("Error:");	echo $e->getMessage();	dispFooter();	exit;}      ?>