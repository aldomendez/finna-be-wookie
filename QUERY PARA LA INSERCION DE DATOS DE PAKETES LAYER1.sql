insert into ilm.pkg_bond 
	(SFCNUMBER,CODE,ENTRY_DATE,SHOP_LOT,OPERATOR,TML,BONDER_ID)
		values
	('','',sysdate,'','','','');

insert all
	into ilm.pkg_bond (SFCNUMBER,CODE,ENTRY_DATE,SHOP_LOT,OPERATOR,BONDER_ID) 
		values ('134009661','1655LO',sysdate,'137914566','20464','CYBONDER')
	into ilm.pkg_bond_comp (SFCNUMBER, COMP_NAME, LOT_ID, SEQ) 
		values ('134009661','PGK_ID_LAYER1','482059','10')
	into ilm.pkg_bond_comp (SFCNUMBER, COMP_NAME, LOT_ID, SEQ) 
		values ('134009661','PGK_ID_LAYER1_SN','133922047','20')
	into ilm.pkg_bond_comp (SFCNUMBER, COMP_NAME, LOT_ID, SEQ) 
		values ('134009661','TEC_LOT_LAYER1','C0822FW','30')
	into ilm.pkg_bond_comp (SFCNUMBER, COMP_NAME, LOT_ID, SEQ) 
		values ('134009661','PACKAGE_LOT_LAYER1','0665','40')
select * from dual