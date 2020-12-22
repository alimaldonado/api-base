import React, {useState} from 'react';
import { Link } from 'react-router-dom'

const Register = () => {
    //register state
    const [user, saveUser] = useState({
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
    });

    //extract from user
    const {name, email, password, confirmPassword} = user;

    const onChange = e =>{
        saveUser({
            ...user,
            [e.target.name]: e.target.value
        })
    }

    //to register 
    const onSubmit = e => {
        e.preventDefault();
        
    }
    return ( 
        <div className="form-usuario">
            <div className="contenedor-form sombra-dark">
                <h1>Create a new account</h1>
                <form onSubmit={onSubmit}>
                    <div className="campo-form">
                        <label htmlFor="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value={name}
                            placeholder="name"
                            onChange={onChange}></input>
                    </div>
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
                        <label htmlFor="confirmPassword">Confirm password</label>
                        <input
                            type="password"
                            id="confirmPassword"
                            name="confirmPassword"
                            value={confirmPassword}
                            placeholder="repeat your password"
                            onChange={onChange}></input>
                    </div>
                    <div className="campo-form">
                        <input type="submit" className="btn btn-primario btn-block" value="Register"></input>
                    </div>
                </form>
                <Link to={'/'} className="enlace-cuenta">Already have an account</Link>
            </div>
        </div>
     );
}
 
export default Register;