<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Usuarios
	     Permission::create([
	        'name'         => 'Listar usuarios',
	        'slug'         => 'users.index',
	        'description'  => 'Lista y navega todos los usuarios del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear usuarios',
	        'slug'         => 'users.create',
	        'description'  => 'Crear usuarios en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle usuarios',
	        'slug'         => 'users.show',
	        'description'  => 'ver en detalle cada usuario del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar usuarios',
	        'slug'         => 'users.edit',
	        'description'  => 'Editar cualquier usuario del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar usuarios',
	        'slug'         => 'users.destroy',
	        'description'  => 'Eliminar cualquier usuario del sistema',
	     ]);


	     //Roles
	     Permission::create([
	        'name'         => 'Listar roles',
	        'slug'         => 'roles.index',
	        'description'  => 'Lista y navega todos los roles del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear roles',
	        'slug'         => 'roles.create',
	        'description'  => 'Crear roles en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle roles',
	        'slug'         => 'roles.show',
	        'description'  => 'ver en detalle cada rol del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar roles',
	        'slug'         => 'roles.edit',
	        'description'  => 'Editar cualquier rol del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar roles',
	        'slug'         => 'roles.destroy',
	        'description'  => 'Eliminar cualquier rol del sistema',
	     ]);


	     //Sostenedores
	     Permission::create([
	        'name'         => 'Listar sostenedores',
	        'slug'         => 'sostenedores.index',
	        'description'  => 'Lista y navega todos los sostenedores del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear sostenedores',
	        'slug'         => 'sostenedores.create',
	        'description'  => 'Crear sostenedores en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle sostenedores',
	        'slug'         => 'sostenedores.show',
	        'description'  => 'ver en detalle cada sostenedor del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar sostenedores',
	        'slug'         => 'sostenedores.edit',
	        'description'  => 'Editar cualquier sostenedor del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar sostenedores',
	        'slug'         => 'sostenedores.destroy',
	        'description'  => 'Eliminar cualquier sostenedor del sistema',
	     ]);


	    //Establecimientos
	     Permission::create([
	        'name'         => 'Listar establecimientos',
	        'slug'         => 'establecimientos.index',
	        'description'  => 'Lista y navega todos los establecimientos del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear establecimientos',
	        'slug'         => 'establecimientos.create',
	        'description'  => 'Crear establecimientos en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle establecimientos',
	        'slug'         => 'establecimientos.show',
	        'description'  => 'ver en detalle cada establecimiento del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar establecimientos',
	        'slug'         => 'establecimientos.edit',
	        'description'  => 'Editar cualquier establecimiento del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar establecimientos',
	        'slug'         => 'establecimientos.destroy',
	        'description'  => 'Eliminar cualquier establecimiento del sistema',
	     ]);


	     //Subvenciones
	     Permission::create([
	        'name'         => 'Listar subvenciones',
	        'slug'         => 'subvenciones.index',
	        'description'  => 'Lista y navega todas las subvenciones del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear subvenciones',
	        'slug'         => 'subvenciones.create',
	        'description'  => 'Crear subvenciones en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle subvenciones',
	        'slug'         => 'subvenciones.show',
	        'description'  => 'ver en detalle cada subvencion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar subvenciones',
	        'slug'         => 'subvenciones.edit',
	        'description'  => 'Editar cualquier subvencion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar subvenciones',
	        'slug'         => 'subvenciones.destroy',
	        'description'  => 'Eliminar cualquier subvencion del sistema',
	     ]);


	     //Leyes
	     Permission::create([
	        'name'         => 'Listar leyes',
	        'slug'         => 'leyes.index',
	        'description'  => 'Lista y navega todas las leyes del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear leyes',
	        'slug'         => 'leyes.create',
	        'description'  => 'Crear leyes en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle leyes',
	        'slug'         => 'leyes.show',
	        'description'  => 'ver en detalle cada ley del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar leyes',
	        'slug'         => 'leyes.edit',
	        'description'  => 'Editar cualquier ley del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar leyes',
	        'slug'         => 'leyes.destroy',
	        'description'  => 'Eliminar cualquier ley del sistema',
	     ]);


	     //Carga Mensual
	     Permission::create([
	        'name'         => 'Listar carga mensual',
	        'slug'         => 'cargamensual.index',
	        'description'  => 'Lista y navega todas las cargas mensuales del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear carga mensual',
	        'slug'         => 'cargamensual.create',
	        'description'  => 'Crear carga mensual en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle carga mensual',
	        'slug'         => 'cargamensual.show',
	        'description'  => 'ver en detalle cada carga mensual del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar carga mensual',
	        'slug'         => 'cargamensual.edit',
	        'description'  => 'Editar cualquier carga mensual del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar carga mensual',
	        'slug'         => 'cargamensual.destroy',
	        'description'  => 'Eliminar cualquier carga mensual del sistema',
	     ]);

	     //Calculo Horas
	     Permission::create([
	        'name'         => 'Listar calculo hora',
	        'slug'         => 'calculohoras.index',
	        'description'  => 'Lista y navega todos los calculos de horas del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear calculo hora',
	        'slug'         => 'calculohoras.create',
	        'description'  => 'Crear calculo hora en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle calculo hora',
	        'slug'         => 'calculohoras.show',
	        'description'  => 'ver en detalle cada calculo hora del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar calculo hora',
	        'slug'         => 'calculohoras.edit',
	        'description'  => 'Editar cualquier calculo hora del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar calculo hora',
	        'slug'         => 'calculohoras.destroy',
	        'description'  => 'Eliminar cualquier calculo hora del sistema',
	     ]);


	     //Cuentas
	     Permission::create([
	        'name'         => 'Listar cuentas',
	        'slug'         => 'cuentas.index',
	        'description'  => 'Lista y navega todas las cuentas del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear cuentas',
	        'slug'         => 'cuentas.create',
	        'description'  => 'Crear cuentas en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle cuentas',
	        'slug'         => 'cuentas.show',
	        'description'  => 'ver en detalle cada cuenta del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar cuentas',
	        'slug'         => 'cuentas.edit',
	        'description'  => 'Editar cualquier cuenta del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar cuentas',
	        'slug'         => 'cuentas.destroy',
	        'description'  => 'Eliminar cualquier cuenta del sistema',
	     ]);


	     //Proveedores
	     Permission::create([
	        'name'         => 'Listar proveedores',
	        'slug'         => 'proveedores.index',
	        'description'  => 'Lista y navega todos los proveedores del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear proveedores',
	        'slug'         => 'proveedores.create',
	        'description'  => 'Crear proveedores en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle proveedores',
	        'slug'         => 'proveedores.show',
	        'description'  => 'ver en detalle cada proveedor del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar proveedores',
	        'slug'         => 'proveedores.edit',
	        'description'  => 'Editar cualquier proveedor del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar proveedores',
	        'slug'         => 'proveedores.destroy',
	        'description'  => 'Eliminar cualquier proveedor del sistema',
	     ]);


	     //Tipos de Documentos
	     Permission::create([
	        'name'         => 'Listar documentos',
	        'slug'         => 'documentos.index',
	        'description'  => 'Lista y navega todos los documentos del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear documentos',
	        'slug'         => 'documentos.create',
	        'description'  => 'Crear documentos en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle documentos',
	        'slug'         => 'documentos.show',
	        'description'  => 'ver en detalle cada documento del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar documentos',
	        'slug'         => 'documentos.edit',
	        'description'  => 'Editar cualquier documento del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar documentos',
	        'slug'         => 'documentos.destroy',
	        'description'  => 'Eliminar cualquier documento del sistema',
	     ]);


	     //Funciones
	     Permission::create([
	        'name'         => 'Listar funciones',
	        'slug'         => 'funciones.index',
	        'description'  => 'Lista y navega todas las funciones del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear funciones',
	        'slug'         => 'funciones.create',
	        'description'  => 'Crear funciones en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle funciones',
	        'slug'         => 'funciones.show',
	        'description'  => 'ver en detalle cada funcion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar funciones',
	        'slug'         => 'funciones.edit',
	        'description'  => 'Editar cualquier funcion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar funciones',
	        'slug'         => 'funciones.destroy',
	        'description'  => 'Eliminar cualquier funcion del sistema',
	     ]);


	     //Funcionarios
	     Permission::create([
	        'name'         => 'Listar funcionarios',
	        'slug'         => 'funcionarios.index',
	        'description'  => 'Lista y navega todos los funcionarios del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear funcionarios',
	        'slug'         => 'funcionarios.create',
	        'description'  => 'Crear funcionarios en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle funcionarios',
	        'slug'         => 'funcionarios.show',
	        'description'  => 'ver en detalle cada funcionario del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar funcionarios',
	        'slug'         => 'funcionarios.edit',
	        'description'  => 'Editar cualquier funcionario del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar funcionarios',
	        'slug'         => 'funcionarios.destroy',
	        'description'  => 'Eliminar cualquier funcionario del sistema',
	     ]);


	     //Imputacion
	     Permission::create([
	        'name'         => 'Listar imputaciones',
	        'slug'         => 'imputaciones.index',
	        'description'  => 'Lista y navega todas las imputaciones del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear imputaciones',
	        'slug'         => 'imputaciones.create',
	        'description'  => 'Crear imputaciones en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle imputaciones',
	        'slug'         => 'imputaciones.show',
	        'description'  => 'ver en detalle cada imputacion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar imputaciones',
	        'slug'         => 'imputaciones.edit',
	        'description'  => 'Editar cualquier imputacion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar imputaciones',
	        'slug'         => 'imputaciones.destroy',
	        'description'  => 'Eliminar cualquier imputacion del sistema',
	     ]);


	     //Reporte de Gastos
	     Permission::create([
	        'name'         => 'Listar reportes',
	        'slug'         => 'reportesgastos.index',
	        'description'  => 'Lista y navega todos los reportes del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear reportes',
	        'slug'         => 'reportesgastos.create',
	        'description'  => 'Crear reportes en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle reportes',
	        'slug'         => 'reportesgastos.show',
	        'description'  => 'ver en detalle cada reporte del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar reportes',
	        'slug'         => 'reportesgastos.edit',
	        'description'  => 'Editar cualquier reporte del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar reportes',
	        'slug'         => 'reportesgastos.destroy',
	        'description'  => 'Eliminar cualquier reporte del sistema',
	     ]);


	     //Liquidacion
	     Permission::create([
	        'name'         => 'Listar liquidaciones',
	        'slug'         => 'liquidaciones.index',
	        'description'  => 'Lista y navega todos los liquidaciones del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear liquidaciones',
	        'slug'         => 'liquidaciones.create',
	        'description'  => 'Crear liquidaciones en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle liquidaciones',
	        'slug'         => 'liquidaciones.show',
	        'description'  => 'ver en detalle cada liquidacion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar liquidaciones',
	        'slug'         => 'liquidaciones.edit',
	        'description'  => 'Editar cualquier liquidacion del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar liquidaciones',
	        'slug'         => 'liquidaciones.destroy',
	        'description'  => 'Eliminar cualquier liquidacion del sistema',
	     ]);


	     //Reporte de RR.HH
	     Permission::create([
	        'name'         => 'Listar reportes',
	        'slug'         => 'reportesrrhh.index',
	        'description'  => 'Lista y navega todos los reportes del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Crear reportes',
	        'slug'         => 'reportesrrhh.create',
	        'description'  => 'Crear reportes en el sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Ver detalle reportes',
	        'slug'         => 'reportesrrhh.show',
	        'description'  => 'ver en detalle cada reporte del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Editar reportes',
	        'slug'         => 'reportesrrhh.edit',
	        'description'  => 'Editar cualquier reporte del sistema',
	     ]);

	     Permission::create([
	        'name'         => 'Eliminar reportes',
	        'slug'         => 'reportesrrhh.destroy',
	        'description'  => 'Eliminar cualquier reporte del sistema',
	     ]);
    }
}
