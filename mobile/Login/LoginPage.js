import React, { Component } from 'react';
import { View, Text, TextInput, TouchableOpacity,StyleSheet ,StatusBar, onButtonPress, Button} from 'react-native';

class LoginPage extends Component {
    render() {
        return (
            <View style={styles.container}>
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
              <TouchableOpacity style={styles.buttonContainer}>
                    <Text  style={styles.buttonText}>LOGIN</Text>
                </TouchableOpacity>
                </View>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
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
    }
   
});

export default LoginPage;