delimiter //

create trigger trg_add_cals_on_amcc before insert on alumno_materia
for each row
begin
	insert into alumno_materia_calif_cuatri(id_alumno_materia,parcial)
    values (new.id_alum_materia,1),(new.id_alum_materia,2),(new.id_alum_materia,3);
end;//

delimiter ;