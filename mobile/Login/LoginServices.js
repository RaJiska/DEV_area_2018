import React, {Component} from 'react';
import {StyleSheet, View, TouchableOpacity, Text, NativeModules} from 'react-native';
import {GoogleSignin} from 'react-native-google-signin';

const { RNTwitterSignIn } = NativeModules

const Constants = {
  //Dev Parse keys
  TWITTER_COMSUMER_KEY: 'U7v6riqMAzPWN0IkAXqr67G3x ',
  TWITTER_CONSUMER_SECRET: 'RjtJxqJG5vyzdCWwX0KALMfl0Bj8MkumZXCrcjX6Y8UcUrPAMs '
}

class LoginServices extends Component {

    _twitterSignIn = () => {
        RNTwitterSignIn.init(Constants.TWITTER_COMSUMER_KEY, Constants.TWITTER_CONSUMER_SECRET)
        RNTwitterSignIn.logIn()
        .then(loginData => {
            console.log(loginData)
            const { authToken, authTokenSecret } = loginData
            if (authToken && authTokenSecret) {
                this.props.twitterSignIn(authToken, authTokenSecret)
            }
        }).catch(error => {
            console.log(error)
        })
    }
    
    _googleSignIn = async () => {

        try {
            GoogleSignin.configure({
                scopes: ['https://www.googleapis.com/auth/gmail.modify'],
                webClientId: '537811531292-7b7dnasht4jgq4j20s394irjaas28gej.apps.googleusercontent.com'
            })
            await GoogleSignin.hasPlayServices();
            const userInfo = await GoogleSignin.signIn();
            const token = await GoogleSignin.getTokens();
            this.props.googleSignIn(token.accessToken)
            console.log(token.accessToken)
          } catch (error) {
            console.log(error)
          }
    }

    render() {
        return (
            <View style={styles.container}>
                <TouchableOpacity style={styles.buttonContainer} onPress={this._twitterSignIn}>
                    <Text style={styles.buttonText}>TWITTER SIGN IN</Text>
                </TouchableOpacity>
                <TouchableOpacity style={styles.buttonContainer} onPress={this._googleSignIn}>
                    <Text style={styles.buttonText}>GOOGLE SIGN IN</Text>
                </TouchableOpacity>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
        paddingVertical: 30,
        padding: 30
    },
    buttonContainer:{
        backgroundColor: '#0effee',
        paddingVertical: 15,
        marginBottom: 15,
        borderRadius: 30,
    },
    buttonText:{
        color: '#fff',
        textAlign: 'center',
        fontWeight: '700'
    },
});

export default LoginServices;