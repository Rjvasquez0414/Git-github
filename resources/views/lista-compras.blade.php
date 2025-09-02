<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras - MT-15 Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
        }

        .add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .input {
            flex: 1;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-add {
            padding: 15px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }

        .lista {
            list-style: none;
        }

        .item {
            background: #f7f7f7;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .item:hover {
            background: #e8e8e8;
            transform: translateX(5px);
        }

        .item-text {
            flex: 1;
            color: #333;
            font-size: 16px;
        }

        .btn-delete {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background: #ff5252;
            transform: scale(1.1);
        }

        .empty {
            text-align: center;
            color: #999;
            padding: 40px;
            font-size: 18px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            width: 100%;
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #5a67d8;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .item {
            animation: slideIn 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Lista de Compras</h1>
        
        <form action="/lista-compras/agregar" method="POST" class="add-form">
            @csrf
            <input type="text" name="item" class="input" placeholder="Agregar nuevo item..." required autofocus>
            <button type="submit" class="btn-add">+ Agregar</button>
        </form>

        @if(count($lista) > 0)
            <ul class="lista">
                @foreach($lista as $item)
                    <li class="item">
                        <span class="item-text">{{ $item['item'] }}</span>
                        <form action="/lista-compras/eliminar/{{ $item['id'] }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-delete">✖ Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty">
                <p>🛒 Tu lista está vacía</p>
                <p style="font-size: 14px; margin-top: 10px;">¡Agrega items para comenzar!</p>
            </div>
        @endif

        <a href="/" class="back-link">← Volver a la tienda</a>
    </div>
</body>
</html>