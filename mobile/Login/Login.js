import React, { Component } from 'react';
import { View, Text, Image, StyleSheet, KeyboardAvoidingView, Dimensions, StatusBar, TextInput, TouchableOpacity} from 'react-native';

class Login extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isRegister: false,
            token: "",
        };
    }
    async logMe() {
       try {
            const response = await fetch(`http://10.15.190.103:8080/user?username=test&login=test@gmail.com&pass=test`, { method: 'GET' });
            const responseJson = await response.json();
            this.setState({ token: responseJson.token });
        }
        catch (error) {
            console.error(error);
        }
    }
    _loginFields() {
        if (!this.state.isRegister) {
            return (
                <View style={styles.containerLogin}>
                    <StatusBar barStyle="light-content"/>
                    <View style={styles.textView}>
                        <Text style={styles.loginText}>Welcome to the AREA</Text>
                    </View>
                    <View style={styles.inputview}>
                        <TextInput style = {styles.input} 
                                autoCapitalize="none" 
                                onSubmitEditing={() => this.passwordInput.focus()} 
                                autoCorrect={false} 
                                keyboardType='email-address' 
                                returnKeyType="next" 
                                placeholder='Email or Mobile Num' 
                                placeholderTextColor='rgba(225,225,225,0.7)'/>
                        <TextInput style = {styles.input}   
                            returnKeyType="go" ref={(input)=> this.passwordInput = input} 
                            placeholder='Password' 
                            placeholderTextColor='rgba(225,225,225,0.7)' 
                            secureTextEntry/>
                        <TouchableOpacity style={styles.buttonContainer} onPress={this.logMe.bind(this)}>
                            <Text  style={styles.buttonText}>LOGIN</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            );
        } else {
            return (
                <View style={styles.containerLogin}>
                    <StatusBar barStyle="light-content"/>
                    <View style={styles.textView}>
                        <Text style={styles.loginText}>Welcome to the AREA</Text>
                    </View>
                    <View style={styles.inputview}>
                        <TextInput style = {styles.input} 
                                autoCapitalize="none" 
                                onSubmitEditing={() => this.passwordInput.focus()} 
                                autoCorrect={false} 
                                keyboardType='email-address' 
                                returnKeyType="next" 
                                placeholder='Email or Mobile Num' 
                                placeholderTextColor='rgba(225,225,225,0.7)'/>
                        <TextInput style = {styles.input}   
                            returnKeyType="go" ref={(input)=> this.passwordInput = input} 
                            placeholder='Password' 
                            placeholderTextColor='rgba(225,225,225,0.7)' 
                            secureTextEntry/>
                        <TextInput style = {styles.input}   
                            returnKeyType="go" ref={(input)=> this.passwordInputConfirm = input} 
                            placeholder='Confirm Password' 
                            placeholderTextColor='rgba(225,225,225,0.7)' 
                            secureTextEntry/>
                        <TouchableOpacity style={styles.buttonContainer}>
                            <Text  style={styles.buttonText}>LOGIN</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            );
        }
    }

    _signUp() {
        if (!this.state.isRegister) {
            return (
                <View style={styles.signupView}>
                    <Text style={styles.signup}>Dont have an account?</Text>
                    <Text style={styles.register} onPress={() => this.register(true)} >Register</Text>
                </View>
            );
        } else {
            return (
                <View style={styles.signupView}>
                    <Text style={styles.signup}>Already have an account?</Text>
                    <Text style={styles.register} onPress={() => this.register(false)} >Login</Text>
                </View>
            );
        }
    }

    register(state) {
        this.setState({ isRegister: state })
    }

    render() {
        return (
            <KeyboardAvoidingView behavior="padding" style={styles.container}>
                <View style={styles.loginContainer}>
                    <Image resizeMode="contain" style={styles.logo} source={require('./blockchain.jpg')} />
                </View>
                <View style={styles.formContainer}>
                    {this._loginFields()}
                    {this._signUp()}
                </View>
            </KeyboardAvoidingView>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
    },
    loginContainer:{
        alignItems: 'center',
        flex: 1,
        justifyContent: 'center'
    },
    logo: {
        position: 'absolute',
        width: Dimensions.get('window').width,
    },
    containerLogin: {
        padding: 30
    },
    input:{
        height: 40,
        backgroundColor: 'rgba(225,225,225,0.2)',
        marginBottom: 10,
        padding: 10,
        color: '#fff',
        borderRadius: 30,
    },
    buttonContainer:{
        backgroundColor: '#0effee',
        paddingVertical: 15,
        borderRadius: 30,
    },
    buttonText:{
        color: '#fff',
        textAlign: 'center',
        fontWeight: '700'
    },
    loginText: {
        fontSize: 25,
        color: 'rgba(37, 241, 227, 0.77)',
    },
    textView:{
        alignItems: 'center'
    },
    inputview:{
        paddingVertical: 10,
    },
    signup:{
		paddingVertical: 15,
		color: '#707070',
	},
	signupView:{
		alignItems: 'center',
	},
    register:{
		color: 'rgba(37, 241, 227, 0.77)',
    },
});

export default Login;