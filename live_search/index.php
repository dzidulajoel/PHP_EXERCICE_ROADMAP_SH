<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Searching</title>
        <style>
                html,
                body {
                        height: 100%;
                        margin: 0;
                        padding: 0;
                        font-family: Arial, sans-serif;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #f0f0f0;
                }

                form {
                        width: 350px;
                        height: 150px;
                        padding: 20px;
                        box-sizing: border-box;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        position: absolute;
                        top: 40%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        display: flex;
                        flex-direction: column;
                        gap: 20px;
                }

                input {
                        border: none;
                        outline: none;
                        font-size: 1rem;
                        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                        border-bottom: 2px solid #0c8af1;
                        height: 50px;
                        padding: 0 0 0 10px;
                }

                button {
                        border: none;
                        height: 50px;
                        font-size: 1rem;
                        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                        background-color: #0c8af1;
                        color: white;
                        cursor: pointer;
                        transition: all .5s;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

                }

                button:hover {
                        background-color: #FFFFFF;
                        color: #0c8af1;
                }

                .def {
                        width: 350px;
                        height: auto;
                        padding: 10px;
                        background-color: white;
                        font-size: 1rem;
                        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                        color: gray;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        margin-top: 40px;
                        border-radius: 8px;
                }
        </style>
</head>

<body>
        <form action="" class="form_search">
                <input type="text" name="recherche" id="" placeholder="Faite votre recherche ...">
                <button type="submit" name='envoie'>Recherche</button>
        </form>
        <div class="def"> Déf : <span class="sorti"></span> </div>

        <script>
                document.querySelector('.form_search').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const form_data = new FormData(this);

                        fetch('traitement.php', {
                                        method: 'POST',
                                        body: form_data
                                })
                                .then(response => response.json())
                                .then(data => {
                                        if (data.status === 'success') {
                                                document.querySelector('.sorti').textContent = data.message;
                                                this.reset()
                                        } else {
                                                document.querySelector('.sorti').textContent = data.message;
                                                this.reset()
                                        }
                                })
                                .catch(e => {
                                        console.log(e, 'Erreur d\'envoie');
                                })
                })
        </script>
</body>

</html>