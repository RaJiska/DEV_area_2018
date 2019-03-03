import React, {Component} from 'react';
import {StyleSheet, View, TouchableOpacity, Text, NativeModules} from 'react-native';

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

    render() {
        return (
            <View style={styles.container}>
                <TouchableOpacity style={styles.buttonContainer} onPress={this._twitterSignIn}>
                    <Text style={styles.buttonText}>TWITTER SIGN IN</Text>
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
        borderRadius: 30,
    },
    buttonText:{
        color: '#fff',
        textAlign: 'center',
        fontWeight: '700'
    },
});

export default LoginServices;