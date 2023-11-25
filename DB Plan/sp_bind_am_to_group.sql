delimiter //

create procedure sp_bind_am_to_group(in grupo int, in id_am int)
begin
	insert into grupo_alumno_mat(id_grupo,id_alum_materia) values (grupo,id_am);
end //

delimiter ;