DELIMITER //

create procedure sp_registrar_alumno(in n varchar(50), in ap varchar(50), in am varchar(50), in ne int, in car int, in ctr int, in g int, in psw varchar(16), out id int)
begin
    -- Declares must go before anything 
    declare id_mat int;
    
    -- Cursors ??
	declare cursor1 cursor for select id_materia from materia where carrera = car and cuatrimestre = ctr; -- Fetches signatures for alumn regarding carrera and cuatrimestre
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = true;
    
	-- Insert the new alumn into alumnos
	insert into alumnos(nombre,apellido_pat,apellido_mat,nivel_educativo,carrera,cuatrimestre,grupo) values (n,ap,am,ne,car,ctr,g);
    set @id_new_alum = last_insert_id();
    select @id_new_alum into id; -- Returns the id of the new registered alumn
    
	-- Add the new alumn credentials
    insert into acceso_alumno values (@id_new_alum,psw);
    
    -- Register the new alumn to their signatures
    open cursor1; -- Reads the values from the cursor's resultset 
    bucle: loop -- Begins a loop
		fetch cursor1 into id_mat; -- Reads the first row of the cursor and stores the value into the variable
        
        if done then -- Checks if the cursor has reached end
			leave bucle; -- Breaks the loop
		end if;
        
        insert into alumno_materia(id_alumno,id_materia) values (@id_new_alum,id_mat); -- Matches the signature with the new alumn
        # Trigger for alumno_materia to insert rows in alumno_materia_calif_cuatri (trg_add_cals_on_amcc)
        # Trigger for alumno_materia to insert rows in alumno_materia_final (trg_add_cal_on_amf)
        
        # Call sp to insert rows in grupo_alumno_mat
        call sp_bind_am_to_group(g,@id_new_alum); -- Arguments: id_grupo, id_alum_materia
    end loop;
    close cursor1;
    
end //

delimiter ;