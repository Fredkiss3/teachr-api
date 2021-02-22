import React from "react";
import {SOutlinedButton, SPrimaryButton} from "./SButton";
import {View, StyleSheet, Image, Text} from "react-native";
import {TeachrType} from "../utils/utils";

interface ItemProps extends TeachrType{
    index: number
}

function FavCard({prenom, formation, description: desc, index}: ItemProps) {
    // pas plus de 130 caractères
    const description = desc ? (desc.length <= 130 ? desc : `${desc.substring(0, 127)}...`) : null;

    return (
        <View style={styles.cardStyle}>
            <View>
                <View style={styles.imageContainerStyle}>
                    <Image
                        style={{
                            ...styles.imageCardStyle,
                        }}
                        source={{
                            uri: `https://i.pravatar.cc/50?u=${index}`,
                        }}
                    />
                    <Text style={styles.nameTextStyle}>
                        {prenom}
                    </Text>
                </View>
            </View>

            <View style={styles.textContainerStyle}>
                <Text style={styles.titleStyle}>
                    Formation
                </Text>
                <Text>
                    {formation}
                </Text>
            </View>

            <View style={styles.textContainerStyle}>
                <Text style={styles.titleStyle}>
                    Description
                </Text>
                <Text>
                    {description}
                </Text>
            </View>
            <View style={styles.buttonContainerStyle}>
                <SPrimaryButton
                    title={"Prendre un cours avec ce Teach'r"}
                    onPress={() => null}
                    textStyle={styles.textButtonStyle}
                    style={{
                        elevation: 0,
                        marginBottom: 10
                    }}
                />
                <SOutlinedButton
                    title={"Retirer ce Teach'r de mes favoris"}
                    onPress={() => null}
                    textStyle={styles.textButtonStyle}
                />
            </View>
        </View>
    )
}

export default FavCard;


const styles = StyleSheet.create({
    cardStyle: {
        elevation: 5,
        height: 380,
        borderRadius: 10,
        padding: 20,
        backgroundColor: "#fff"
    },

    imageContainerStyle: {
        display: "flex",
        alignContent: "space-between",
        alignItems: "center",
        flexDirection: "row",
    },

    imageCardStyle: {
        width: 40,
        height: 40,
        borderRadius: 50,
        marginEnd: 10
    },

    nameTextStyle: {
        fontSize: 18,
        maxWidth: 130
    },

    titleStyle: {
        color: "#b7b1b1"
    },

    textContainerStyle: {
        marginTop: 20
    },

    buttonContainerStyle: {
        marginTop: 20
    },

    textButtonStyle: {
        fontSize: 12
    }
});
