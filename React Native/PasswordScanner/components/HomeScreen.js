// Homescreen.js
import React, { Component } from 'react';
import { Button, View, Text, StyleSheet } from 'react-native';

class HomeScreen extends Component {
  render() {
    return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text style = {styles.Title}>Select a Scanner Size:</Text>
        <Button
          title="Small Scanner"
          onPress={() => this.props.navigation.navigate('Small')}
        />
         <Button
          title="Medium Scanner"
          onPress={() => this.props.navigation.navigate('Medium')}
        />
         <Button
          title="Large Scanner"
          onPress={() => this.props.navigation.navigate('Large')}
        />
        <Button
          title="Full Screen Scanner"
          onPress={() => this.props.navigation.navigate('FullScreen')}
        />
         </View>
    );
  }
}
export default HomeScreen;

const styles = StyleSheet.create({
  Title: {
    fontWeight:'bold',
    fontSize:20,
  },

});