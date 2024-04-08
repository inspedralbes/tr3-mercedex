export default function ({ req, res, next }) {
    // Permite solicitudes desde cualquier origen
    res.setHeader('Access-Control-Allow-Origin', '*');
    // Configura otros encabezados CORS según sea necesario
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
    next();
  }