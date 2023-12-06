delimiter //

create procedure sp_registrar_docente(in n varchar(50), in ap varchar(50), in am varchar(50), in hpd int, in psw varchar(16), out id int)
begin
	-- Insert the new teacher into docentes
	insert into docentes(nombre,apellido_pat,apellido_mat,horas_por_dia) values (n,ap,am,hpd);
    set @id_new_doc = last_insert_id();
    select @id_new_doc into id; -- Returns the id of the new registered alumn
    
    -- Add the new teacher credentials
    insert into acceso_docente values (@id_new_doc,psw);
end //

delimiter ;