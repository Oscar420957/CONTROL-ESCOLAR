delimiter //

create trigger trg_add_cal_on_amf before insert on alumno_materia
for each row
begin
	insert into alumno_materia_final(id_alumno_materia) values (new.id_alum_materia);
end;//

delimiter ;	