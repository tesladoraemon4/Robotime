competidor

cve_equ,appat_com,apmat_com,nom_com,cap_com


robot

nom_rob,cve_cat,cve_equ




categoria
cve_cat
nom_cat

equipo
cve_equ,nom_equ,mail_equ,tel_equ,pag_equ
e.cve_equ,e.mail_equ,e.nom_equ,e.tel_equ,e.pag_equ 


pelea
cve_pel,arb_pel,gan_pel,lvp_pel,disp_pel,cve_rob1,cve_rob2,cve_rob




create database Robotime;
use Robotime;

create table categoria(cve_cat int(1)
,nom_cat varchar(20));

create table equipo(
	cve_equ int(5),
	nom_equ varchar(25),
	mail_equ varchar(30),
	tel_equ int(12),
	pag_equ bit(1),
	ase_equ int(5)--AGREGADA!!!!!!!!!!!!!!!!!!!!
);

create table robot(
nom_rob varchar(25),
cve_cat int(1),
cve_equ int(5)
);

create table competidor(
cve_equ int(5),
appat_com varchar(30),
apmat_com varchar(30),
nom_com varchar(15),
);









sigue lineas




























