import React, { Component } from 'react';
import { View, Text, Image, StyleSheet,KeyboardAvoidingView, Dimensions } from 'react-native';
import LoginPage from './LoginPage';
import SignUp from './Signup'

class Login extends Component {
    render() {
        return (
            <KeyboardAvoidingView behavior="padding" style={styles.container}>
                <View style={styles.loginContainer}>
                    <Image resizeMode="contain" style={styles.logo} source={require('./blockchain.jpg')} />
                </View>
                <View style={styles.formContainer}>
                    <LoginPage />
                    <SignUp />
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
});

export default Login;