import React, { Component } from 'react';
import { View, Text, Image, StyleSheet, KeyboardAvoidingView, Dimensions, StatusBar, TextInput, TouchableOpacity, NativeModules } from 'react-native';


const { RNTwitterSignIn } = NativeModules

const Constants = {
  //Dev Parse keys
  TWITTER_COMSUMER_KEY: 'U7v6riqMAzPWN0IkAXqr67G3x ',
  TWITTER_CONSUMER_SECRET: 'RjtJxqJG5vyzdCWwX0KALMfl0Bj8MkumZXCrcjX6Y8UcUrPAMs '
}
class Login extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isRegister: false,
            token: "",
            username: "",
            password: ""
        };
    }

    _twitterSignIn = () => {
        RNTwitterSignIn.init(Constants.TWITTER_COMSUMER_KEY, Constants.TWITTER_CONSUMER_SECRET)
        RNTwitterSignIn.logIn()
          .then(loginData => {
            console.log(loginData)
            const { authToken, authTokenSecret } = loginData
            if (authToken && authTokenSecret) {
              this.props.twitterSignIn(authToken, authTokenSecret)
            }
          })
          .catch(error => {
            console.log(error)
          }
        )
    }

    async logMe() {
       try {
            const response = await fetch('http://10.15.190.103:8080/user?login=' + this.state.username + '&pass=' + this.state.password, { method: 'GET' });
            const responseJson = await response.json();
            this.setState({ token: responseJson.token, username: "", password: "" });
            this.props.setUser(this.state.token);
        }
        catch (error) {
            console.error(error);
        }
    }

    async registerMe() {
        try {
            var formData = new FormData();
            formData.append('login', this.state.username);
            formData.append('pass', this.state.password);
            const response = await fetch('http://10.15.190.103:8080/user', {
                method: 'POST',
                body: formData,
            });
            const responseJson = await response.json();
            this.setState({ token: responseJson.token, username: "", password: "" });
            this.props.setUser(this.state.token);
        }
        catch (error) {
            console.error(error);
        }
    }

    _button() {
        if (!this.state.isRegister) {
            return (
                <TouchableOpacity style={styles.buttonContainer} onPress={this.logMe.bind(this)}>
                    <Text style={styles.buttonText}>LOGIN</Text>
                </TouchableOpacity>
            );
        } else {
            return (
                <TouchableOpacity style={styles.buttonContainer} onPress={this.registerMe.bind(this)}>
                    <Text style={styles.buttonText}>REGISTER</Text>
                </TouchableOpacity>
            );
        }
    }

    _loginFields() {
        return (
            <View style={styles.containerLogin}>
                <StatusBar barStyle="light-content"/>
                <View style={styles.textView}>
                    <Text style={styles.loginText}>Welcome to the AREA</Text>
                </View>
                <View style={styles.inputview}>
                    <TextInput style = {styles.input}
                        autoCapitalize="none" 
                        onChangeText={(username) => this.setState({username})}
                        value={this.state.username}
                        autoCorrect={false} 
                        returnKeyType="next" 
                        placeholder='Login' 
                        placeholderTextColor='rgba(225,225,225,0.7)'/>
                    <TextInput style = {styles.input}   
                        returnKeyType="go"
                        onChangeText={(password) => this.setState({password})}
                        value={this.state.password}
                        placeholder='Password' 
                        placeholderTextColor='rgba(225,225,225,0.7)' 
                        secureTextEntry/>
                    {this._button()}
                </View>
            </View>
        );
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
        marginBottom: 20
	},
    register:{
		color: 'rgba(37, 241, 227, 0.77)',
    },
});

export default Login;