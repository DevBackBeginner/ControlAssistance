<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Entrada</title>
</head>
<body>
    <h2>Registro de Entrada con Huella</h2>
    <button id="escanearHuella">Escanear Huella</button>
    <p id="resultado"></p>

    <script>
        document.getElementById("escanearHuella").addEventListener("click", async function () {
            try {
                const cred = await navigator.credentials.get({
                    publicKey: {
                        challenge: new Uint8Array(32),
                        allowCredentials: [{ type: "public-key" }]
                    }
                });

                let huellaID = btoa(JSON.stringify(cred));
                
                // Enviar la huella al servidor
                fetch("registrarEntrada", {
                    method: "POST",
                    body: JSON.stringify({ huella: huellaID }),
                    headers: { "Content-Type": "application/json" }
                })
                .then(response => response.text())
                .then(data => document.getElementById("resultado").innerText = data)
                .catch(error => console.error("Error:", error));

            } catch (error) {
                console.error("Error al escanear huella:", error);
                document.getElementById("resultado").innerText = "No se pudo escanear la huella.";
            }
        });
    </script>
</body>
</html>
