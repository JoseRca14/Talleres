import express from 'express';
import sendEmails from './correo.js'; // Importar la función de envío de correos

const app = express();
const port = 3000;

// Middleware para parsear JSON
app.use(express.json());

// Ruta para recibir los datos desde PHP
app.post('/enviar-correos', async (req, res) => {
    const { emails, subject, htmlContent } = req.body;

    if (!emails || !subject || !htmlContent) {
        return res.status(400).json({ error: 'Faltan datos requeridos.' });
    }

    try {
        // Llamar a la función para enviar los correos
        await sendEmails(emails, subject, htmlContent);
        res.status(200).json({ message: 'Correos enviados correctamente.' });
    } catch (error) {
        console.error('Error al enviar correos:', error);
        res.status(500).json({ error: 'Error al enviar correos.' });
    }
});

// Iniciar el servidor
app.listen(port, () => {
    console.log(`Servidor Node.js escuchando en http://localhost:${port}`);
});