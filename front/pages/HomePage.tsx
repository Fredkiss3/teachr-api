import React from "react";
import {StyleSheet, Text, View} from "react-native";
import {SPrimaryButton} from "../components/SButton";

export function HomePage({navigation}) {
    return (
        <View style={styles.container}>
            <Text style={styles.header}>
                Teach'r
            </Text>
            <SPrimaryButton
                // color={"red"}
                style={{
                    marginTop: 20
                }}
                textStyle={{
                    fontSize: 15
                }}
                onPress={() => navigation.navigate('Fav')}
                title={"Voir les favoris"}
            />
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#fff',
        alignItems: 'center',
        justifyContent: 'center',
    },

    header: {
        fontSize: 40,
        fontFamily: "Roboto",
        color: "dodgerblue"
    },
});