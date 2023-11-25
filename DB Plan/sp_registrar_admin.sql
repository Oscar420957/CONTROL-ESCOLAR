delimiter //

create procedure sp_registrar_admin(in n varchar(50), in ap varchar(50), in am varchar(50), in psw varchar(16), out id int)
begin
	-- Insert the new admin into administrativo
	insert into administrativo(nombre,apellido_pat,apellido_mat) values (n,ap,am);
    set @id_new_admin = last_insert_id();
    select @id_new_admin into id; -- Returns the id of the new registered alumn
    
    -- Add the new admin credentials
    insert into acceso_admin values (@id_new_admin,psw);
end //

delimiter ;