delimiter //

create procedure sp_materia_by_docente(in id_mat int, in id_grup int, in id_doc int)
begin
	insert into materia_docente(id_materia,id_docente) values (id_mat,id_doc);
	set @id_new_md = last_insert_id();
    
    # Call sp to insert rows in grupo_docente_mat
    call sp_bind_md_to_group(id_grup,@id_new_md);
end //

delimiter ;