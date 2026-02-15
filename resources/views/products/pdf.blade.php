<!DOCTYPE html>
<html>
<head>
    <title>Inventaire Brina-Oyas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        table { w-full; border-collapse: collapse; width: 100%; }
        th { background-color: #f8fafc; color: #475569; padding: 10px; border: 1px solid #e2e8f0; text-align: left; }
        td { padding: 10px; border: 1px solid #e2e8f0; }
        .text-right { text-align: right; }
        .alert { color: #e11d48; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BRINA-OYAS</h1>
        <p>Rapport d'Inventaire Global - Date : {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Catégorie</th>
                <th class="text-right">Prix (FCFA)</th>
                <th class="text-right">Stock</th>
                <th class="text-right">Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td class="text-right">{{ number_format($product->price, 0, ',', ' ') }}</td>
                <td class="text-right {{ $product->stock_quantity <= $product->stock_min ? 'alert' : '' }}">
                    {{ $product->stock_quantity }}
                </td>
                <td class="text-right">{{ number_format($product->price * $product->stock_quantity, 0, ',', ' ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Valeur Totale du Stock : {{ number_format($totalValue, 0, ',', ' ') }} FCFA
    </div>
</body>
</html>