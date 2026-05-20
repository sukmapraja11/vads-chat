const express = require('express');

const http = require('http');

const { Server } = require('socket.io');

const cors = require('cors');

const app = express();

app.use(cors());

const server = http.createServer(app);

const io = new Server(server, {

    cors: {

        origin: "*"

    }

});



io.on('connection', (socket) => {

    console.log('User connected');



    /*
    |--------------------------------------------------------------------------
    | JOIN ROOM
    |--------------------------------------------------------------------------
    */

    socket.on('join_room', (room) => {

        socket.join(room);

        console.log('JOIN ROOM:', room);

    });



    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    socket.on('send_message', (data) => {

        console.log('MESSAGE:', data);

        io.to(data.room)
            .emit('receive_message', data);

    });



    /*
    |--------------------------------------------------------------------------
    | NEW CUSTOMER
    |--------------------------------------------------------------------------
    */

    socket.on('new_customer', (data) => {

        console.log('NEW CUSTOMER:', data);

        io.emit('customer_list_update', data);

    });



    socket.on('disconnect', () => {

        console.log('User disconnected');

    });

});



server.listen(3000, () => {

    console.log(
        'Socket server running on port 3000'
    );

});