<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cotizacion;
use App\Models\Evento;
use App\Models\Audit;
use App\Mail\emailCrearCotizacion;
use Illuminate\Support\Facades\Mail;

use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeNotifications($userId){
        $rol = $userId->rol_id;
        $email = $userId->email;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isCotizacionAdmin = false;
        $isEventoAdmin = false;
        if($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones') || $privilegios->contains('nombre_privilegio', 'Consultar cotizaciones')){
            $isCotizacionAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos') || $privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $isEventoAdmin = true;
        }

        if($isCotizacionAdmin && $isEventoAdmin){
            $cotizaciones = Cotizacion::where('estado_cotizacion', '=', 'Por responder')->get();
            $numCotizaciones = $cotizaciones->count();
            $eventos = Evento::where('fecha_evento', '=', date('Y-m-d'))->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
            if ($numCotizaciones > 0) {
                $notificaciones[] = array('tipo' => 'Cotizaciones', 'cantidad' => $numCotizaciones);
            }

        }else{
            $eventos = Evento::where('invitados_evento', 'like', "%$email%")->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
        }
        return $notificaciones;
    }

    public function eventosDia($userId)
    {
        $email = $userId->email;
        if($email){
            $eventosDelDia = Evento::where('invitados_evento', 'like', "%$email%")
                                    ->where('fecha_evento', '=', date('Y-m-d'))
                                    ->get();
        } else {
            $eventosDelDia = null;
        }
        return $eventosDelDia;
    }

    public function getPermissions(){
        $userId = auth()->user()->id;
        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isProductoAdmin = false;
        $canViewProductos = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar productos')){
            $isProductoAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar productos')){
            $canViewProductos = true;
        }

        return array('isProductoAdmin' => $isProductoAdmin, 'canViewProductos' => $canViewProductos);
    }

    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];
        $canViewProductos = $this->getPermissions()['canViewProductos'];

        if($isProductoAdmin || $canViewProductos){
            if($request->has('search')){
                $productos = Producto::where('nombre_producto', 'LIKE', '%'.$request->search.'%')
                ->orWhere('id', '=', $request->search)
                ->orWhere('precio_producto', '=', $request->search)
                ->paginate(30);

                foreach($productos as $producto){
                    $producto->imagen = \DB::table('product_image')
                        ->join('image', 'product_image.image_id', '=', 'image.id')
                        ->select('image.path')
                        ->where('product_image.producto_id', '=', $producto->id)
                        ->first();

                    if(!$producto->imagen){
                        $producto->imagen = 'xd';
                    }else{
                        $producto->imagen = $producto->imagen->path;
                    }
                }
                return view('productos.productosInicio', compact('productos', 'notificaciones', 'isProductoAdmin', 'eventosDelDiaHoy'));

            }else{
                //Traer todos los productos seleccionar una imagen por producto. Tablas: productos, product_image, image
                $productos = Producto::paginate(30);

                foreach($productos as $producto){
                    $producto->imagen = \DB::table('product_image')
                        ->join('image', 'product_image.image_id', '=', 'image.id')
                        ->select('image.path')
                        ->where('product_image.producto_id', '=', $producto->id)
                        ->first();

                    if(!$producto->imagen){
                        $producto->imagen = 'xd';
                    }else{
                        $producto->imagen = $producto->imagen->path;
                    }
                }
                return view('productos.productosInicio', compact('productos', 'notificaciones', 'isProductoAdmin', 'eventosDelDiaHoy'));
            }
            return view('productos.productosInicio', compact('productos', 'notificaciones', 'isProductoAdmin', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];

        if($isProductoAdmin){
            return view('productos.registrarProducto', compact('notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProducto=request()->except('_token', 'images');
        $images = $request->file('images');
        Producto::insert($datosProducto);

        //Iterar sobre $datosProducto['images'] para guardar cada imagen en la carpeta storage/app/public/uploads/productos/
        foreach($images as $image){
            $path = $image->store('files', 'public');
            \DB::table('image')->insert([
                'path' => $path,
            ]);

            $image_id = \DB::table('image')->where('path', '=', $path)->first()->id;
            $producto_id = \DB::table('productos')->orderBy('id', 'desc')->first()->id;
            \DB::table('product_image')->insert([
                'producto_id' => $producto_id,
                'image_id' => $image_id,
            ]);

        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'productos',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosProducto['nombre_producto']
        ]);

        $producto = Producto::orderBy('id', 'desc')->first();
        return redirect('/productos/'.$producto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];
        $canViewProductos = $this->getPermissions()['canViewProductos'];
        $images = \DB::table('product_image')
            ->join('image', 'product_image.image_id', '=', 'image.id')
            ->select('image.path', 'image.id')
            ->where('product_image.producto_id', '=', $id)
            ->get();

        if($isProductoAdmin || $canViewProductos){
            $productos = Producto::find($id);
            return view('productos.visualizarProducto', ['producto'=>$productos], compact('notificaciones', 'isProductoAdmin', 'images', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];

        if($isProductoAdmin){
            $producto=Producto::findOrFail($id);
            $images = \DB::table('product_image')
                ->join('image', 'product_image.image_id', '=', 'image.id')
                ->select('image.path', 'image.id')
                ->where('product_image.producto_id', '=', $id)
                ->get();
            return view('productos.modificarProducto', compact('producto', 'notificaciones', 'images', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosProducto=request()->except(['_token', '_method', 'images']);
        $datosProductoUp = request()->except(['_token', '_method', 'accion', 'images']);

        Producto::where('id', '=', $id)->update($datosProductoUp);

        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $path = $image->store('files', 'public');
                \DB::table('image')->insert([
                    'path' => $path,
                ]);

                $image_id = \DB::table('image')->where('path', '=', $path)->first()->id;

                \DB::table('product_image')->insert([
                    'producto_id' => $id,
                    'image_id' => $image_id,
                ]);

            }
        }

        $producto=Producto::findOrFail($id);

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        if(isset($datosProducto['accion'])){
            $accion = $datosProducto['accion'];
        }else{
            $accion = "modificacion";
        }

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'productos',
            'tipo_accion' => $accion,
            'fecha_accion' => $fechaActual,
            'item' => $producto->nombre_producto
        ]);

        return redirect('productos/'.$producto->id);
    }

    public function showCatalogue(Request $request){
        $filter = '';
        $order = '';
        if($request->has('filter')){
            if($request->filter == 'habitaciones_mayor'){
                $filter = 'habitaciones_producto';
                $order = 'desc';
            }
            if($request->filter == 'habitaciones_menor'){
                $filter = 'habitaciones_producto';
                $order = 'asc';
            }
            if($request->filter == 'tamaño_mayor'){
                $filter = 'tamaño_producto';
                $order = 'desc';
            }
            if($request->filter == 'tamaño_menor'){
                $filter = 'tamaño_producto';
                $order = 'asc';
            }

            $products = Producto::where('estado_producto', '=', 'Publicado')->orderBy($filter, $order)->get();
        }else{
            $products = Producto::where('estado_Producto', '=', 'Publicado')->get();
        }
        foreach($products as $product){
            $product->image = \DB::table('product_image')
                ->join('image', 'product_image.image_id', '=', 'image.id')
                ->select('image.path')
                ->where('product_image.producto_id', '=', $product->id)
                ->first();

            if(!$product->image){
                $product->image = 'xd';
            }else{
                $product->image = $product->image->path;
            }
        }

        return view('welcome', compact('products'));
    }

    public function showProduct($id){
        $product = Producto::findOrFail($id);
        $images = \DB::table('product_image')
            ->join('image', 'product_image.image_id', '=', 'image.id')
            ->select('image.path', 'image.id')
            ->where('product_image.producto_id', '=', $id)
            ->get();

        return view('home.productCatalogue', compact('product', 'images'));
    }

    public function makeQuotation($id){
        $product = Producto::findOrFail($id);
        $images = \DB::table('product_image')
            ->join('image', 'product_image.image_id', '=', 'image.id')
            ->select('image.path', 'image.id')
            ->where('product_image.producto_id', '=', $id)
            ->get();

        return view('home.makeQuotation', compact('product', 'images'));
    }

    public function storeQuotation(Request $request){
        $cotizacion = request()->except('_token');
        $email= request('email_cotizante');
        Cotizacion::insert($cotizacion);
        // obtener id para enviar al correo del cliente
        $cotizacionEmail = Cotizacion::latest('id')->first();
        // Enviar email de la cotización
        if($email){
            Mail::to($email)->send(new emailCrearCotizacion($cotizacionEmail));
        }

        return redirect('/');
    }

    public function reporteProductos(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar productos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $productoNombre = $request->get('searchBar');
            if($productoNombre){
                $productos = Producto::select('*')->where('nombre_producto', 'like', "%$productoNombre%")->get();
            } else {
                $productos = Producto::all();
            }

            $productoEstado = $request->get('estado_Producto1');
            $productoPisos = $request->get('pisos_producto1');

            if($productoEstado){
                $productos = Producto::select('*')->where('estado_Producto', '=', $productoEstado)->get();
            }
            if($productoPisos){
                $productos = Producto::select('*')->where('pisos_producto', 'like', "%$productoPisos%")->get();
            }

            $productoNombTable = $request->get('nombre_producto');
            $productoDescripTable = $request->get('descripcion_producto');
            $productoPrecioTable = $request->get('precio_producto');
            $productoTipoTable = $request->get('tipo_producto');
            $productoMaterialTable = $request->get('material_producto');
            $productoPisosTable = $request->get('pisos_producto');
            $productoTamanioTable = $request->get('tamaño_producto');
            $productoHabitacionTable = $request->get('habitaciones_producto');
            $productoEstadoTable = $request->get('estado_Producto');

            $arreglo = [];
            if($productoNombTable){
                $arreglo[] = $productoNombTable;
            }
            if($productoDescripTable){
                $arreglo[] = $productoDescripTable;
            }
            if($productoDescripTable){
                $arreglo[] = $productoDescripTable;
            }
            if($productoPrecioTable){
                $arreglo[] = $productoPrecioTable;
            }
            if($productoTipoTable){
                $arreglo[] = $productoTipoTable;
            }
            if($productoMaterialTable){
                $arreglo[] = $productoMaterialTable;
            }
            if($productoPisosTable){
                $arreglo[] = $productoPisosTable;
            }
            if($productoTamanioTable){
                $arreglo[] = $productoTamanioTable;
            }
            if($productoHabitacionTable){
                $arreglo[] = $productoHabitacionTable;
            }
            if($productoEstadoTable){
                $arreglo[] = $productoEstadoTable;
            }

            if($arreglo and $productoNombTable){
                $campos = '';
                foreach($arreglo as $valor){
                    $campos .= ", `" .$valor. "`";
                }
                $productos = DB::select('SELECT id' .$campos. ' FROM productos;');
            }

            return view('productos.crearReporteProductos', compact('productos', 'notificaciones', 'eventosDelDiaHoy'));
        } else {
            return redirect()->back();
        }
    }

    public function exportPdfProductos(Request $request)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar productos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $productos = Producto::all();
            $productos = compact('productos');
            $pdf = Pdf::loadView('productos.exportPdf', $productos);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteProductos.pdf');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
