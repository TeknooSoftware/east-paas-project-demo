const http = require('http');
const date = require('date-and-time');

const hostname = '0.0.0.0';
const port = 4563;

const server = http.createServer((req, res) => {
 console.log(req.headers);
 res.statusCode = 200;
 const now = new Date();
 res.end(
   '<html><body><h1>Hello World from NodeJS!</h1>'
   + 'We are the ' + date.format(now, 'YYYY/MM/DD HH:mm:ss')
   + '</body></html>'
 );
})

server.listen(port, hostname);
