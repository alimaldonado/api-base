import React, {useState} from 'react';
import { Link } from 'react-router-dom'

const Login = () => {
    //login state
    const [user, saveUser] = useState({
        email: '',
        password: ''
    });

    //extract from user
    const {email, password} = user;

    const onChange = e =>{
        saveUser({
            ...user,
            [e.target.name]: e.target.value
        })
    }

    //to login 
    const onSubmit = e => {
        e.preventDefault();
        
    }
    return ( 
        <div className="form-usuario">
            <div className="contenedor-form sombra-dark">
                <h1>Login to your account</h1>
                <form onSubmit={onSubmit}>
                    <div className="campo-form">
                        <label htmlFor="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value={email}
                            placeholder="email"
                            onChange={onChange}></input>
                    </div>
                    <div className="campo-form">
                        <label htmlFor="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            value={password}
                            placeholder="password"
                            onChange={onChange}></input>
                    </div>
                    <div className="campo-form">
                        <input type="submit" className="btn btn-primario btn-block" value="Log in"></input>
                    </div>
                </form>
                <Link to={'/register'} className="enlace-cuenta">Create account</Link>
            </div>
        </div>
     );
}
 
export default Login;