import os
import numpy as np
from flask import Flask, request, jsonify
from tensorflow.keras.preprocessing import image
from tensorflow.keras.layers import Input, GlobalAveragePooling2D, Concatenate, Dense
from tensorflow.keras.models import Model
from tensorflow.keras.applications import InceptionV3, ResNet50

app = Flask(__name__)

# Define class names
class_names = ['AMD', 'Cataract', 'DR', 'Glaucoma', 'Hypertensive', 'Myopia', 'Normal', 'Other']

# Reconstruct the hybrid model architecture
def create_hybrid_model(input_shape=(224, 224, 3), num_classes=8):
    input_layer = Input(shape=input_shape)
    inception_base = InceptionV3(weights=None, include_top=False, input_tensor=input_layer)
    resnet_base = ResNet50(weights='imagenet', include_top=False, input_tensor=input_layer)
    inception_features = inception_base.output
    resnet_features = resnet_base.output
    inception_gap = GlobalAveragePooling2D()(inception_features)
    resnet_gap = GlobalAveragePooling2D()(resnet_features)
    concatenated_features = Concatenate()([inception_gap, resnet_gap])
    output_layer = Dense(num_classes, activation='softmax')(concatenated_features)
    model = Model(inputs=input_layer, outputs=output_layer)
    return model

# Load model and weights
model = create_hybrid_model()
model.compile(optimizer='adam', loss='sparse_categorical_crossentropy', metrics=['accuracy'])
model.load_weights('hybrid_weight_on_res.h5')  # Ensure this file exists in your project root

# Image preprocessing function
def preprocess_image(file_path):
    img = image.load_img(file_path, target_size=(224, 224))
    img_array = image.img_to_array(img)
    img_array = img_array / 255.0  # Normalize
    img_array = np.expand_dims(img_array, axis=0)
    return img_array

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({'error': 'No image uploaded'}), 400

    file = request.files['image']
    if file.filename == '':
        return jsonify({'error': 'No filename provided'}), 400

    temp_dir = 'temp_uploads'
    os.makedirs(temp_dir, exist_ok=True)
    file_path = os.path.join(temp_dir, file.filename)
    file.save(file_path)

    try:
        img_array = preprocess_image(file_path)
        prediction = model.predict(img_array)[0]
        top_idx = int(np.argmax(prediction))
        predicted_label = class_names[top_idx]
        confidence = float(prediction[top_idx])

        os.remove(file_path)  # Cleanup

        return jsonify({
            'predicted_class': predicted_label,
            'confidence': confidence,
            'probabilities': {
                class_names[i]: float(prediction[i]) for i in range(len(class_names))
            }
        })
    except Exception as e:
        os.remove(file_path)
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
