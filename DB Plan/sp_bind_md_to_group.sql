delimiter //

create procedure sp_bind_md_to_group(in grupo int, in id_md int)
begin
	insert into grupo_docente_mat(id_grupo,id_mat_doc) values (grupo,id_md);
end //

delimiter ;